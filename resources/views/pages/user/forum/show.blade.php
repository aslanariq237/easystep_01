<x-app-layout>
    <div class="min-h-screen bg-gray-50 pb-20">

        <!-- Header -->
        <div class="bg-white border-b sticky top-0 z-50">
            <div class="max-w-4xl mx-auto px-4 py-4 flex items-center gap-4">
                <a href="{{ route('forum.index') }}" 
                   class="flex items-center gap-2 text-gray-600 hover:text-purple-600">
                    ← Kembali ke Forum
                </a>
                <span class="text-gray-400">|</span>
                <span class="text-sm text-gray-500">Diskusi Parenting</span>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 py-6">

            <!-- Postingan Utama -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                
                <!-- Header Post -->
                <div class="px-6 pt-6 pb-4 border-b">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-indigo-500 text-white rounded-2xl flex items-center justify-center text-2xl font-medium">
                            {{ strtoupper(substr($forumPost->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $forumPost->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $forumPost->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Isi Post -->
                <div class="px-6 py-8 text-gray-700 leading-relaxed text-[17px]">
                    {{ $forumPost->content }}
                </div>

                <!-- Like & Comment Count -->
                <div class="px-6 py-5 border-t flex items-center gap-8 text-gray-500">
                    <div class="flex items-center gap-2">
                        <span class="text-2xl">❤️</span>
                        <span class="font-medium">{{ $forumPost->likes_count ?? 0 }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl">💬</span>
                        <span class="font-medium">{{ $forumPost->comments->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Form Balas / Komentar -->
            <div class="bg-white rounded-3xl shadow-sm p-6 mb-8">
                <h3 class="font-semibold text-gray-800 mb-4">Berikan Komentar / Balasan</h3>
                
                <form action="{{ route('forum-comments.post', $forumPost) }}" method="POST">
                    @csrf
                    <textarea name="content" 
                              rows="4"
                              class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:border-purple-300 resize-none"
                              placeholder="Tulis komentar atau balasanmu di sini..."></textarea>
                    
                    <div class="flex justify-end mt-4">
                        <button type="submit"
                                class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-2xl font-medium flex items-center gap-2 transition">
                            Kirim Komentar 
                            <span class="text-xl">→</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Daftar Semua Komentar -->
            <div>
                <h3 class="font-semibold text-gray-800 mb-6 flex items-center gap-2">
                    <span>Komentar</span>
                    <span class="text-sm font-normal text-gray-500">({{ $forumPost->comments->count() }})</span>
                </h3>

                @if($forumPost->comments->isEmpty())
                    <div class="bg-white rounded-3xl p-10 text-center text-gray-500">
                        Belum ada komentar. Jadilah yang pertama berkomentar!
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach($forumPost->comments as $comment)
                        <div class="bg-white rounded-3xl p-6 shadow-sm">
                            <div class="flex gap-4">
                                <div class="w-10 h-10 bg-gray-200 rounded-2xl flex-shrink-0 flex items-center justify-center text-lg">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <p class="font-semibold text-gray-800">{{ $comment->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                    <p class="mt-2 text-gray-700 leading-relaxed">
                                        {{ $comment->content }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

        <!-- Bottom Navigation Mobile -->
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t md:hidden z-50">
            <div class="max-w-xl mx-auto grid grid-cols-4 py-2 text-center">
                <a href="{{ route('dashboard') }}" class="flex flex-col items-center text-gray-500 hover:text-gray-700">
                    <span class="text-3xl">🏠</span>
                    <span class="text-[10px] mt-1">Home</span>
                </a>
                <a href="{{ route('modules.index') }}" class="flex flex-col items-center text-gray-500 hover:text-gray-700">
                    <span class="text-3xl">📚</span>
                    <span class="text-[10px] mt-1">Courses</span>
                </a>
                <a href="{{ route('articles.index') }}" class="flex flex-col items-center text-gray-500 hover:text-gray-700">
                    <span class="text-3xl">📖</span>
                    <span class="text-[10px] mt-1">Articles</span>
                </a>
                <a href="{{ route('forum.index') }}" class="flex flex-col items-center text-purple-600">
                    <span class="text-3xl">💬</span>
                    <span class="text-[10px] mt-1 font-medium">Forum</span>
                </a>
            </div>
        </div>

    </div>
</x-app-layout>