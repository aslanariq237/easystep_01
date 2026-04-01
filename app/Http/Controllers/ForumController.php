<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ForumPost;
use App\Models\ForumComment;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forumPosts = ForumPost::with('comments', 'user')->get();
        // return response()->json($forumPosts);
        return view('pages.user.forum.index', compact('forumPosts'));
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:10|max:1000',
        ]);

        ForumPost::create([
            'user_id'   => Auth::id(),
            'title'     => 'Diskusi Penting',
            'content'   => $request->content,
            'like'      => 0,
        ]);

        return redirect()->route('forum.index')
            ->with('success', 'Berhasil Menambahkan Postingan');
    }   
    
    public function storeComment(Request $request, ForumPost $forumPost)
    {
        $request->validate([
            'content' => 'required|string|min:10|max:1000',
        ]);

        ForumComment::create([
            'forum_post_id' => $forumPost->id,
            'user_id'       => Auth::id(),
            'content'       => $request->content,
        ]);

        return redirect()->route('forum.show', $forumPost)
                        ->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function toggleLike(Request $request, ForumPost $forumPost)
    {
        $user = Auth::user();

        // Untuk sementara kita pakai cara sederhana (bisa dikembangkan nanti)
        // Agar tidak like berkali-kali oleh user yang sama, sebaiknya pakai tabel pivot
        // Tapi sesuai request kamu, kita buat toggle sederhana dulu

        // Catatan: Cara ini masih global (semua user melihat like count yang sama)
        // Jika ingin per-user like, kita perlu tabel pivot nanti

        // Untuk sekarang, kita buat toggle dummy (bisa di klik berkali-kali)
        if (session()->has("liked_post_{$forumPost->id}")) {
            // Unlike
            $forumPost->unlike();
            session()->forget("liked_post_{$forumPost->id}");
            $status = 'unliked';
        } else {
            // Like
            $forumPost->toogleLike();
            session()->put("liked_post_{$forumPost->id}", true);
            $status = 'liked';
        }

        // Jika request AJAX (untuk experience lebih baik)
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'like' => $forumPost->like,
                'status' => $status
            ]);
        }

        return redirect()->back()->with('success', $status === 'liked' ? 'Berhasil menyukai postingan!' : 'Like telah dibatalkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(ForumPost $forumPost)
    {
        $forumPost->load('user', 'comments.user');
        // return response()->json($forumPosts);
        return view('pages.user.forum.show', compact('forumPost'));
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
