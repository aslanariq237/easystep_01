<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();

        return view('pages.user.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',            
            'content'  => 'required|string',
            'image'    => 'nullable|image|mimes:jpeg,png,webp,jpg|max:5120',
        ]);

        $data = [
            'title'      => $validated['title'],
            'slug'       => \Str::slug($validated['title']),
            'content'    => $validated['content'],                        
            'uploaded_by'=> Auth::user()->name,
        ];

        // Upload Image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles/images', 'public');
        }

        Article::create($data);

        return redirect()->route('adminDashboard')
                        ->with('success', 'Artikel berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
