<x-app-layout>
    <div class="min-h-screen bg-gray-50 pb-20">        
        <header class="bg-white text-white">
            <div class="max-w-7xl mx-auto px-4 pt-6 pb-8">
                <div class="relative rounded-3xl overflow-hidden h-[260px] md:h-[320px]">
                    <img src="{{ asset('assets/kid_learn_3.jpg')}}" 
                         alt="Forum Parenting" 
                         class="absolute inset-0 w-full h-full object-cover">
                    
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>
                    
                    <div class="absolute inset-0 flex items-center px-6 md:px-12">
                        <div class="max-w-lg">
                            <h2 class="text-white text-3xl md:text-4xl font-bold leading-tight">
                                Learn About Your Little One<br>With Other Parents
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-4 -mt-6 relative z-10">            
            <div class="bg-white rounded-3xl shadow-sm p-6 mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-purple-100 rounded-2xl flex items-center justify-center text-2xl">👤</div>
                    <div>
                        <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Bagikan pengalaman atau tanyakan sesuatu</p>
                    </div>
                </div>

                <form action="{{ route('forum.store') }}" method="POST" id="forumForm">
                    @csrf
                    <textarea name="content"  id="content"
                              rows="3"
                              class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:border-purple-300 resize-none"
                              placeholder="Type your text..."></textarea>
                              
                    <div id="content-error" class="text-sm text-red-500 mt-2">
                        Pesan harus minimal 10 karakter.
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" id="submit-btn"
                                class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-2xl font-medium flex items-center gap-2 transition">
                            Send 
                            <span class="text-xl">→</span>
                        </button>
                    </div>
                </form>
            </div>            
            <div class="space-y-6">
                @foreach($forumPosts as $post)
                <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100" id="post-{{ $post->id }}">
                    
                    <div class="px-6 pt-6 pb-4 border-b">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-500 text-white rounded-2xl flex items-center justify-center text-xl font-medium">
                                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $post->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <!-- Titik Tiga Menu -->
                            @if(Auth::id() === $post->user_id)
                            <div class="relative">
                                <button onclick="togglePostMenu({{ $post->id }})" 
                                        class="text-gray-400 hover:text-gray-600 text-2xl leading-none">⋯</button>
                                
                                <div id="post-menu-{{ $post->id }}" class="hidden absolute right-0 mt-2 bg-white rounded-2xl shadow-xl py-2 w-40 border border-gray-100 z-50">
                                    <button onclick="editPost({{ $post->id }})" 
                                            class="block w-full text-left px-5 py-3 hover:bg-gray-100 flex items-center gap-2">
                                        Edit
                                    </button>
                                    <form action="{{ route('forum.destroy', $post) }}" method="POST" 
                                        onsubmit="return confirm('Yakin ingin menghapus postingan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full text-left px-5 py-3 hover:bg-red-50 text-red-600 flex items-center gap-2">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>                    

                    <!-- Content Area -->
                    <div class="px-6 py-6 text-gray-700 leading-relaxed" id="content-view-{{ $post->id }}">
                        {{ $post->content }}
                    </div>

                    <!-- Edit Form (Hidden by default) -->
                    <div class="hidden px-6 py-6" id="content-edit-{{ $post->id }}">
                        <textarea id="edit-textarea-{{ $post->id }}" 
                                class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:border-purple-500"
                                rows="5">{{ $post->content }}</textarea>
                        
                        <div class="flex gap-3 mt-4">
                            <button onclick="cancelEdit({{ $post->id }})" 
                                    class="flex-1 py-3 border border-gray-300 rounded-2xl text-gray-600 font-medium">
                                Batal
                            </button>
                            <button onclick="saveEdit({{ $post->id }})" 
                                    class="flex-1 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-2xl font-medium">
                                Simpan
                            </button>
                        </div>
                    </div>

                    <!-- Like & Comment -->
                    <div class="px-6 pb-6 flex items-center justify-between text-gray-500 border-t pt-4">
                        <div class="flex items-center gap-8">                            
                            <a href="{{ route('forum.show', $post) }}" class="flex items-center gap-2 hover:text-purple-600 transition">
                                <span class="text-2xl">💬</span>
                                <span class="font-medium">{{ $post->comments->count() }}</span>
                            </a>                                
                            <form action="{{ route('forum.like', $post) }}" method="POST" class="like-form">
                                @csrf
                                <button type="submit" class="like-button flex items-center gap-2 hover:text-red-500 transition">
                                    <span class="text-2xl like-icon">❤️</span>
                                    <span class="font-medium likes-count">{{ $post->like ?? 0 }}</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Preview Comments -->
                    @if($post->comments->isNotEmpty())
                    <div class="bg-gray-50 px-6 py-5 border-t">
                        @foreach($post->comments->take(2) as $comment)
                        <div class="flex gap-3 mb-4 last:mb-0">
                            <div class="w-8 h-8 bg-gray-300 rounded-2xl flex-shrink-0 flex items-center justify-center text-sm">
                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-sm">{{ $comment->user->name }}</p>
                                <p class="text-gray-600 text-sm">{{ $comment->content }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            {{-- <div class="space-y-6">
                @foreach($forumPosts as $post)
                <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100">                    
                    <div class="px-6 pt-6 pb-4 border-b">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-500 text-white rounded-2xl flex items-center justify-center text-xl font-medium">
                                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $post->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="px-6 py-6 text-gray-700 leading-relaxed">
                        {{ $post->content }}
                    </div>

                    <div class="px-6 pb-6 flex items-center justify-between text-gray-500 border-t pt-4">
                        <div class="flex items-center gap-8">                            
                                <a href="{{ route('forum.show', $post) }}" 
                                class="flex items-center gap-2 hover:text-purple-600 transition">
                                    <span class="text-2xl">💬</span>
                                    <span class="font-medium">{{ $post->comments->count() }}</span>
                                </a>                                
                                <form action="{{ route('forum.like', $post) }}" method="POST" class="like-form">
                                    @csrf
                                    <button type="submit"
                                            class="like-button flex items-center gap-2 hover:text-red-500 transition focus:outline-none {{ session()->has("liked_post_{$post->id}") ? 'text-red-500' : '' }}">
                                        <span class="text-2xl like-icon">❤️</span>
                                        <span class="font-medium likes-count">{{ $post->like ?? 0 }}</span>
                                    </button>
                                </form>
                            </div>
                    
                            {{-- <a href="{{ route('forum.show', $post) }}" 
                            class="text-purple-600 text-sm font-medium hover:underline">
                                Lihat detail →
                            </a>
                        </div>                    
                    @if($post->comments->isNotEmpty())
                    <div class="bg-gray-50 px-6 py-5 border-t">
                        @foreach($post->comments->take(2) as $comment)
                        <div class="flex gap-3 mb-4 last:mb-0">
                            <div class="w-8 h-8 bg-gray-300 rounded-2xl flex-shrink-0 flex items-center justify-center text-sm">
                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-sm">{{ $comment->user->name }}</p>
                                <p class="text-gray-600 text-sm">{{ $comment->content }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @endforeach

                        @if($post->comments->count() > 2)
                        <a href="{{ route('forum.show', $post) }}" 
                           class="text-purple-600 text-sm font-medium hover:underline">
                            Lihat semua {{ $post->comments->count() }} komentar →
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
                @endforeach
            </div> --}}

        </div>        
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t md:hidden z-50 shadow-lg">
        <div class="max-w-xl mx-auto grid grid-cols-4 py-2 text-center">            
            <a href="{{ route('dashboard') }}" 
            class="flex flex-col items-center py-2 rounded-2xl mx-1 transition-all
                    {{ request()->is('/') || request()->is('dashboard') ? 'bg-purple-100 text-purple-600' : 'text-gray-500 hover:text-gray-700' }}">
                <span class="text-3xl">🏠</span>
                <span class="text-[10px] mt-1 font-medium">Home</span>
            </a>            
            <a href="{{ route('modules.index') }}" 
            class="flex flex-col items-center py-2 rounded-2xl mx-1 transition-all
                    {{ request()->is('modules*') || request()->is('module_*') ? 'bg-purple-100 text-purple-600' : 'text-gray-500 hover:text-gray-700' }}">
                <span class="text-3xl">📚</span>
                <span class="text-[10px] mt-1 font-medium">Modul</span>
            </a>            
            <a href="{{ route('articles.index') }}" 
            class="flex flex-col items-center py-2 rounded-2xl mx-1 transition-all
                    {{ request()->is('articles*') ? 'bg-purple-100 text-purple-600' : 'text-gray-500 hover:text-gray-700' }}">
                <span class="text-3xl">📖</span>
                <span class="text-[10px] mt-1 font-medium">Artikel</span>
            </a>            
            <a href="{{ route('forum.index') }}" 
            class="flex flex-col items-center py-2 rounded-2xl mx-1 transition-all
                    {{ request()->is('forum*') ? 'bg-purple-100 text-purple-600' : 'text-gray-500 hover:text-gray-700' }}">
                <span class="text-3xl">💬</span>
                <span class="text-[10px] mt-1 font-medium">Forum</span>
            </a>

        </div>
    </div>

    </div>
    <script>        
        const form = document.getElementById('forumForm');
        const textarea = document.getElementById('content');
        const errorDiv = document.getElementById('content-error');
        const submitBtn = document.getElementById('submit-btn');

        form.addEventListener('submit', function(e) {
            const content = textarea.value.trim();
            
            if (content.length < 10) {
                e.preventDefault();
                errorDiv.textContent = 'Pesan harus minimal 10 karakter.';
                errorDiv.classList.remove('hidden');
                textarea.classList.add('border-red-500');
                return false;
            }
        });

        // Real-time validation
        textarea.addEventListener('input', function() {
            const content = this.value.trim();
            if (content.length >= 10) {
                errorDiv.classList.add('hidden');
                textarea.classList.remove('border-red-500');
            }
        });

        function togglePostMenu(postId) {
            const menu = document.getElementById(`post-menu-${postId}`);
            menu.classList.toggle('hidden');
        }

        // Tutup semua menu jika klik di luar
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative')) {
                document.querySelectorAll('[id^="post-menu-"]').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }
        });
        function togglePostMenu(postId) {
            document.querySelectorAll('[id^="post-menu-"]').forEach(menu => {
                if (menu.id !== `post-menu-${postId}`) menu.classList.add('hidden');
            });
            document.getElementById(`post-menu-${postId}`).classList.toggle('hidden');
        }

        function editPost(postId) {
            document.getElementById(`content-view-${postId}`).classList.add('hidden');
            document.getElementById(`content-edit-${postId}`).classList.remove('hidden');
            document.getElementById(`post-menu-${postId}`).classList.add('hidden');
        }

        function cancelEdit(postId) {
            document.getElementById(`content-view-${postId}`).classList.remove('hidden');
            document.getElementById(`content-edit-${postId}`).classList.add('hidden');
        }

        function saveEdit(postId) {
            const textarea = document.getElementById(`edit-textarea-${postId}`);
            const content = textarea.value.trim();

            if (content.length < 10) {
                alert("Isi postingan minimal 10 karakter");
                return;
            }

            // Kirim via AJAX
            fetch(`/forum/${postId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ content: content })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`content-view-${postId}`).innerHTML = content;
                    cancelEdit(postId);
                    alert("Postingan berhasil diperbarui");
                }
            })
            .catch(error => alert("Gagal menyimpan perubahan"));
        }
    </script>
</x-app-layout>