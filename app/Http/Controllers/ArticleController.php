<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
            'image_url'=> 'string',
        ]);

        $data = [
            'title'      => $validated['title'],
            'slug'       => \Str::slug($validated['title']),
            'content'    => $validated['content'],                        
            'uploaded_by'=> Auth::user()->name,
            'image_url'  => $validated['image_url']
        ];                

        Article::create($data);

        return redirect()->route('adminDashboard')
                        ->with('success', 'Artikel berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('pages.user.articles.detail', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('pages.admin.article.create', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'image_url'  => 'nullable|url|max:500',
            'content'    => 'required|string|min:50',
        ]);

        try {
            DB::beginTransaction();

            $article->update([
                'title'       => $request->title,
                'slug'        => Str::slug($request->title),
                'content'     => $request->content,
                'image_url'   => $request->image_url,
                'uploaded_by' => Auth::user()->name,
            ]);

            DB::commit();

            return redirect()->route('adminDashboard')
                            ->with('success', 'Artikel berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Update Article Error: ' . $e->getMessage());

            return redirect()->back()
                            ->with('error', 'Terjadi kesalahan saat memperbarui artikel. Silakan coba lagi.')
                            ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('adminDashboard')
                         ->with('success', 'Article Berhasil dihapus');
    }
}
