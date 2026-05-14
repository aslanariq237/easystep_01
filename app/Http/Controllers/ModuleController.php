<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\ModuleDetail;
use App\Models\Article;
use App\Models\ForumPost;
use App\Models\ProgressActivities;
use App\Models\User;
use App\Models\ModuleAccessHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parentModules = Module::where('type', 'parent')            
            ->get();                

        return view('pages.user.modules.index_parent', compact('parentModules'));
    }
    public function indexParent()
    {
        $parentModules = Module::where('type', 'parent')            
            ->get();        

        return view('pages.user.modules.index_parent', compact('parentModules'));
    }    

    public function indexChildren()
    {        
        $childrenModules = Module::where('type', 'children')            
            ->get();

        return view('pages.user.modules.index_children', compact('childrenModules'));
    } 
    
    public function adminDashboard()
    {   
        $totalModules = Module::count();
        $totalArticles = Article::count();
        $totalParents = User::role('admin')->count();
        $totalForumPosts = ForumPost::count();

        $recentModules = Module::latest()->take(6)->get();

        return view('pages.admin.dashboard', compact(
            'totalModules',
            'totalArticles',
            'totalParents',
            'totalForumPosts',
            'recentModules'
        ));
    }

    public function dashboard()
    {
        $modules = Module::where('type', 'parent')
                        ->paginate(3);
        $articles = Article::paginate(3);
                
        return view('dashboard', compact('modules', 'articles'));
    }

    public function userDashboard()
    {

    }

    public function detail(Module $module, $sectionId = null){
        $module->load('sections');        
        if ($sectionId) {
            $currentSection = ModuleDetail::where('module_id', $module->id)
                                ->where('id', $sectionId)
                                ->firstOrFail();
        } else {
            $currentSection = $module->sections()->orderBy('id')->first();
        }

        if (!$currentSection) {
            abort(404, 'Sub-bab tidak ditemukan');
        }

        $this->recordProgress($module->id);        

        $prevSection = ModuleDetail::where('module_id', $module->id)
                        ->where('id', '<', $currentSection->id)
                        ->orderBy('id', 'desc')
                        ->first();

        $nextSection = ModuleDetail::where('module_id', $module->id)
                        ->where('id', '>', $currentSection->id)
                        ->orderBy('id')
                        ->first();

        $totalSections = $module->sections->count();

        return view('pages.user.modules.detail', compact(
            'module',
            'currentSection',
            'prevSection',
            'nextSection',
            'totalSections',            
        ));
    }

    private function recordProgress($moduleId)
    {
        ProgressActivities::updateOrCreate(
            [
                'user_id'   => Auth::id(),
                'module_id' => $moduleId,
            ],
            [
                'accessed_at' => now(),
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        $user = auth()->user();

        $type = $module->type;        

        $progress = ModuleAccessHistory::firstOrCreate(
            [
                'user_id'   => $user->id,
                'module_id' => $module->id,
                'type'      => $type,
            ],
            [                
                'accessed_at'      => now(),
            ]
        );   
        $progress = $module->getProgressForUser($user->id);        

        return view('pages.user.modules.show', compact('module', 'progress'));        
    }

    //admin function disini

    public function adminIndex(){
        $modules = Module::with('creator')
                ->orderBy('type')                
                ->get();
        // return response()->json($modules);
        return view('admin.modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.modules.create');
    }

    //ini function ditujukan untuk merubah game"nya
    private function getGame($type)
    {
        return match($type) {
            'quiz'  => 'games/quiz/index.html',
            default => null,
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $user = Auth::user();
        $data = [
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'type'          => $request->type,
            'description'   => $request->description,
            'content'       => $request->content, 
            'image_url'     => $request->image_url,                       
            'uploaded_by'   => $user->name,
        ];                

        $module = Module::create($data);

        foreach($request->sections as $index => $section){
            $detailData = [  
                'title'         => $section['title'],
                'module_id'     => $module->id,
                'content'       => $section['content'] ?? null,
                'has_image'     => !empty($section['image_url']) ? 1 : 0,
                'has_video'     => !empty($section['video_url']) ? 1 : 0,                
                'has_game'      => !empty($section['game_file']) ? 1 : 0,
                'image_url'     => $section['image_url'] ?? null,
                'video_url'     => $section['video_url'] ?? null,
                'game_type'     => $section['game_type'] ?? null,
                'game_file'     => $this->getGame($section['game_type']) ?? null,
            ];            

            ModuleDetail::create($detailData);
        }

        return redirect()->route('adminDashboard')
            ->with('success', 'Module Berhasil di Buat');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)    
    {
        $module->load('sections');
        // return response()->json($module);
        return view('pages.admin.modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */        
    public function update(Request $request, Module $module)
    {

        $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|in:parent,children',
            'description' => 'required|string',            
            'sections.*.title'   => 'required|string|max:255',
            'sections.*.content' => 'nullable|string',          
        ]);

        try {
            DB::beginTransaction();

            // Update Module Utama
            $module->update([
                'title'       => $request->title,
                'slug'        => Str::slug($request->title),
                'type'        => $request->type,
                'description' => $request->description,
            ]);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('modules/images', 'public');            
            } 

            $module->sections()->delete();

            foreach ($request->sections as $index => $section) {
                $detailData = [
                    'user_id'       => Auth::id(),
                    'module_id'     => $module->id,
                    'title'         => $section['title'],
                    'content'       => $section['content'] ?? null,
                    'has_image'     => $request->hasFile("images.$index") ? 1 : 0,
                    'has_video'     => $request->hasFile("videos.$index") ? 1 : 0,
                    'has_game'      => !empty($section['game_type']) ? 1 : 0,
                    'image_url'     => $section['image_url'] ?? null,
                    'video_url'     => $section['video_url'] ?? null,
                    'game_type'     => $section['game_type'] ?? null,
                    'game_file'     => $this->getGame($section['game_type']) ?? null,
                ];                

                ModuleDetail::create($detailData);
            }

            DB::commit();

            return redirect()->route('admin.dashboard')
                            ->with('success', 'Module berhasil diperbarui beserta sub-babnya.');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Update Module Error: ' . $e->getMessage());

            return redirect()->back()
                            ->with('error', 'Terjadi kesalahan saat memperbarui module.')
                            ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {            
        $module->delete();        

        return redirect()->route('adminDashboard')
                        ->with('success', 'Module berhasil dihapus');
    }
}
