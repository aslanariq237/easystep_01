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

        return view('admin.modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.modules.create');
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
            'uploaded_by'   => $user->name,
        ];        

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('modules/images', 'public');            
        }        

        $module = Module::create($data);

        foreach($request->sections as $index => $section){
            $detailData = [                
                'module_id'     => $module->id,
                'content'       => $section['content'] ?? null,
                'has_image'     => !empty($section['image']) ? 1 : 0,
                'has_video'     => !empty($section['video']) ? 1 : 0,
            ];

            if($request->hasFile("sections.$index.image")){
                $detailData['image'] = $request->file("sections.$index.image")
                        ->store('module-details/images', 'public');
            }
            if($request->hasFile("sections.$index.video")){
                $detailData['video'] = $request->file("sections.$index.video")
                        ->store('module-details/video', 'public');
            }
            // if (!empty($section['video']) && $section['video']) {
            //     $detailData['video'] = $section['video']->store('module-details/videos', 'public');
            // }
            // if (!empty($section['image']) && $section['image']) {
            //     $detailData['image'] = $request->file('image')->store('modules/images', 'public');
            //     $detailData['image'] = $section['image']->store('module-details/images', 'public');
            // }                        

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
    public function update(Module $module, Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|in:parent,children',
            'description' => 'required|string',            
            'sections.*.title'   => 'required|string|max:255',
            'sections.*.content' => 'nullable|string',            
        ]);
        try {
            DB::BeginTransaction();
            $module->update([
                'title'       => $request->title,
                'slug'        => Str::slug($request->title),
                'type'        => $request->type,
                'description' => $request->description,
            ]);
            $module->sections()->delete();

            foreach($request->input('sections') as $index => $section){
                $detailData = [
                    'user_id'    => Auth::id(),
                    'module_id'  => $module->id,
                    'content'    => $section['content'] ?? null,
                    'has_image'  => $request->hasFile("images.$index") ? 1 : 0,
                    'has_video'  => $request->hasFile("videos.$index") ? 1 : 0,
                ];

                if ($request->hasFile("images.$index")) {
                    $detailData['image'] = $request->file("images.$index")->store('module-details/images', 'public');
                }

                if ($request->hasFile("videos.$index")) {
                    $detailData['video'] = $request->file("videos.$index")->store('module-details/videos', 'public');
                }

                ModuleDetail::create($detailData);
            }
            DB::commit();
            return redirect()->route('admin.dashboard')
                            ->with('success', 'Module berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error saat update Module: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal membuat transaksi. Silakan coba lagi.')
                ->withInput();
        }                       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($module->image) {
            \Storage::disk('public')->delete($module->image);
        }

        foreach ($module->details as $detail) {
            if ($detail->image) \Storage::disk('public')->delete($detail->image);
            if ($detail->video) \Storage::disk('public')->delete($detail->video);
        }

        $module->delete();

        return redirect()->route('admin.dashboard')
                        ->with('success', 'Module berhasil dihapus');
    }
}
