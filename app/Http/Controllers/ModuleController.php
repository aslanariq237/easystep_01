<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Article;
use App\Models\ForumPost;
use App\Models\User;
use App\Models\ModuleAccessHistory;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    public function detail(){
        ModuleAccessHistory::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'module_id' => $module->id,
                'type'      => $module->type,
                'accessed_at' => now()                
            ]
        );
        $module->load('user');

        return view('pages.user.module.detail', compact('module'));
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

        return view('pages.user.modules.show', compact('module'));
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
            'description'   => $request->description,
            'content'       => $request->content,
            'type'          => $request->type,
            'uploaded_by'   => $user->name,
        ];        

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('modules/images', 'public');            
        }
        
        if ($request->hasFile('video')) {
            $data['videos'] = $request->file('video')->store('modules/videos', 'public');            
        }

        Module::create($data);

        return redirect()->route('adminDashboard')
            ->with('success', 'Module Berhasil di Buat');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
