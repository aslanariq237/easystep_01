{{-- <x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-8">

            <h2 class="text-3xl font-bold text-gray-800 mb-8">Admin Dashboard</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="bg-white rounded-3xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Modules</p>
                            <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalModules }}</p>
                        </div>
                        <div class="text-5xl opacity-20">📚</div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Articles</p>
                            <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalArticles }}</p>
                        </div>
                        <div class="text-5xl opacity-20">📝</div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Parents</p>
                            <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalParents }}</p>
                        </div>
                        <div class="text-5xl opacity-20">👨‍👩‍👧</div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Forum Posts</p>
                            <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalForumPosts }}</p>
                        </div>
                        <div class="text-5xl opacity-20">💬</div>
                    </div>
                </div>
            </div>
            
            <div class="mb-12">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <a href="{{ route('modules.create') }}" 
                       class="bg-white hover:bg-purple-50 border border-purple-200 rounded-3xl p-8 transition group">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">📚</div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-2">Buat Module Baru</h4>
                        <p class="text-gray-500">Tambah module untuk Parent atau Children</p>
                    </a>
                    
                    <a href="{{ route('articles.create') }}" 
                       class="bg-white hover:bg-purple-50 border border-purple-200 rounded-3xl p-8 transition group">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">📝</div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-2">Buat Article Baru</h4>
                        <p class="text-gray-500">Tambah artikel parenting baru</p>
                    </a>

                    <button onclick="showAddParentModal()" 
                            class="bg-white hover:bg-emerald-50 border border-emerald-200 rounded-3xl p-8 transition group text-left">
                        <div class="text-6xl mb-6">👨‍👩‍👧</div>
                        <h4 class="text-2xl font-bold text-gray-800">Tambah Parent</h4>
                        <p class="text-gray-500">Buat akun orang tua baru</p>
                    </button>
                    
                    <a href="{{ route('forum.index') }}" 
                       class="bg-white hover:bg-purple-50 border border-purple-200 rounded-3xl p-8 transition group">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">💬</div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-2">Kelola Forum</h4>
                        <p class="text-gray-500">Lihat diskusi dari para orang tua</p>
                    </a>

                </div>
            </div>
            
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Module Terbaru</h3>
                    <a href="{{ route('modules.index') }}" 
                       class="text-purple-600 hover:text-purple-700 text-sm font-medium">Lihat Semua →</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentModules as $module)
                        <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group">
                            
                            @if($module->image_url)
                            <img src="{{ $module->image_url }}" 
                                alt="{{ $module->title }}" 
                                class="w-full h-48 object-cover">
                            @else
                            <div class="h-48 bg-gray-200 flex items-center justify-center text-6xl">
                                📖
                            </div>
                            @endif

                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-xs px-3 py-1 rounded-full 
                                        {{ $module->type === 'parent' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ ucfirst($module->type) }}
                                    </span>
                                </div>
                                
                                <h4 class="font-semibold line-clamp-2 mb-6 text-gray-800">{{ $module->title }}</h4>                                
                                <div class="flex gap-2">                                    
                                    <a href="{{ route('modules.show', $module) }}" 
                                    class="flex-1 flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-2xl text-sm font-medium transition">
                                        <span>👁</span>
                                        <span>Lihat</span>
                                    </a>                                    
                                    <a href="{{ route('modules.edit', $module) }}" 
                                    class="flex-1 flex items-center justify-center gap-2 bg-blue-100 hover:bg-blue-200 text-blue-700 py-3 rounded-2xl text-sm font-medium transition">
                                        <span>✏️</span>
                                        <span>Edit</span>
                                    </a>                                    
                                    <form action="{{ route('modules.destroy', $module) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Yakin ingin menghapus module ini beserta semua sub-babnya?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex-1 flex items-center justify-center gap-2 bg-red-100 hover:bg-red-200 text-red-700 py-3 rounded-2xl text-sm font-medium transition">
                                            <span>🗑</span>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-12">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">Article Terbaru</h3>
                        <a href="{{ route('articles.index') }}" 
                        class="text-purple-600 hover:text-purple-700 text-sm font-medium">Lihat Semua →</a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">                
                        @foreach($recentArticles as $article)
                        <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all border border-gray-100 flex flex-col">
                                                        
                            <div class="h-56 bg-gray-200 relative">
                                @if($article->image_url)
                                    <img src="{{ $article->image_url }}" 
                                        alt="{{ $article->title }}" 
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="h-full bg-gray-200 flex items-center justify-center text-6xl">
                                        📖
                                    </div>
                                @endif
                            </div>                        
                                                        
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center gap-2 text-emerald-600 text-xs font-medium mb-3">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                    {{ $article->created_at->diffForHumans() }}
                                </div>
                                
                                <h3 class="font-semibold text-gray-800 leading-tight mb-3 line-clamp-2">
                                    {{ $article->title }}
                                </h3>
                                
                                <p class="text-gray-600 text-sm line-clamp-3 mb-6 flex-1">
                                    {{ Str::limit(strip_tags($article->content), 160) }}
                                </p>
                                                                
                                <div class="flex gap-2 mt-auto pt-4 border-t">
                                    <a href="{{ route('articles.show', $article) }}" 
                                    class="flex-1 flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-2xl text-sm font-medium transition">
                                        <span>👁</span>
                                        <span>Lihat</span>
                                    </a>                                    
                                    
                                    <a href="{{ route('articles.edit', $article) }}" 
                                    class="flex-1 flex items-center justify-center gap-2 bg-blue-100 hover:bg-blue-200 text-blue-700 py-3 rounded-2xl text-sm font-medium transition">
                                        <span>✏️</span>
                                        <span>Edit</span>
                                    </a>                                    
                                    
                                    <form action="{{ route('articles.destroy', $article) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Yakin ingin menghapus article ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex-1 flex items-center justify-center gap-2 bg-red-100 hover:bg-red-200 text-red-700 py-3 rounded-2xl text-sm font-medium transition">
                                            <span>🗑</span>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="addParentModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">
                            <div class="bg-white rounded-3xl w-full max-w-md mx-4 overflow-hidden">
                                <div class="p-8">
                                    <h3 class="text-2xl font-bold mb-6">Tambah Parent Baru</h3>
                                    
                                    <form action="{{ route('users.store') }}" method="POST">
                                        @csrf
                                        
                                        <div class="mb-5">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                            <input type="text" name="name" required 
                                                class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                                        </div>

                                        <div class="mb-5">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                            <input type="email" name="email" required 
                                                class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                                        </div>

                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                            <input type="password" name="password" required 
                                                class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                                        </div>

                                        <div class="flex gap-3">
                                            <button type="button" onclick="hideAddParentModal()" 
                                                    class="flex-1 py-4 border border-gray-300 rounded-2xl font-medium">
                                                Batal
                                            </button>
                                            <button type="submit" 
                                                    class="flex-1 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-2xl">
                                                Tambahkan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>            
        </div>
    </div>
    <script>
        function showAddParentModal() {
            document.getElementById('addParentModal').classList.remove('hidden');
        }

        function hideAddParentModal() {
            document.getElementById('addParentModal').classList.add('hidden');
        }

        // Klik di luar modal untuk close
        document.getElementById('addParentModal').addEventListener('click', function(e) {
            if (e.target.id === 'addParentModal') hideAddParentModal();
        });
    </script>
</x-app-layout> --}}
<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-4xl font-bold text-gray-800">Admin Dashboard</h2>
                    <p class="text-gray-500 mt-1">Selamat datang kembali, Admin</p>
                </div>
                <div class="text-sm text-gray-500">
                    {{ now()->format('d F Y') }}
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Modules</p>
                            <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalModules }}</p>
                        </div>
                        <div class="text-5xl">📚</div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Articles</p>
                            <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalArticles }}</p>
                        </div>
                        <div class="text-5xl">📝</div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Parents</p>
                            <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalParents }}</p>
                        </div>
                        <div class="text-5xl">👨‍👩‍👧</div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Forum Posts</p>
                            <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalForumPosts }}</p>
                        </div>
                        <div class="text-5xl">💬</div>
                    </div>
                </div>
            </div>            
            <div class="mb-12">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <a href="{{ route('modules.create') }}" class="group bg-white border border-purple-100 hover:border-purple-300 rounded-3xl p-8 transition-all">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">📚</div>
                        <h4 class="text-2xl font-bold">Buat Module</h4>
                        <p class="text-gray-500 mt-1">Parent & Children</p>
                    </a>

                    <a href="{{ route('articles.create') }}" class="group bg-white border border-purple-100 hover:border-purple-300 rounded-3xl p-8 transition-all">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">📝</div>
                        <h4 class="text-2xl font-bold">Buat Article</h4>
                        <p class="text-gray-500 mt-1">Konten Parenting</p>
                    </a>

                    <button onclick="showAddParentModal()" 
                            class="group bg-white border border-emerald-100 hover:border-emerald-300 rounded-3xl p-8 transition-all text-left w-full">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">👨‍👩‍👧</div>
                        <h4 class="text-2xl font-bold">Tambah Parent</h4>
                        <p class="text-gray-500 mt-1">Buat akun orang tua baru</p>
                    </button>

                    <a href="{{ route('forum.index') }}" class="group bg-white border border-purple-100 hover:border-purple-300 rounded-3xl p-8 transition-all">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">💬</div>
                        <h4 class="text-2xl font-bold">Kelola Forum</h4>
                        <p class="text-gray-500 mt-1">Diskusi Komunitas</p>
                    </a>
                </div>
            </div>            
            <div class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Daftar Parent</h3>
                    <button onclick="showAddParentModal()" 
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-2xl text-sm font-medium flex items-center gap-2">
                        <span>+</span> Tambah Parent
                    </button>
                </div>

                <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Nama</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Email</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-600">Bergabung</th>
                                <th class="px-6 py-4 text-center text-sm font-medium text-gray-600">Status</th>
                                <th class="px-6 py-4 w-32"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($parents as $parent)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-5 font-medium">{{ $parent->name }}</td>
                                <td class="px-6 py-5 text-gray-600">{{ $parent->email }}</td>
                                <td class="px-6 py-5 text-gray-500 text-sm">{{ $parent->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-5 text-center">
                                    <span class="inline-block px-4 py-1 text-xs font-medium bg-emerald-100 text-emerald-700 rounded-full">Active</span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <form 
                                        method="POST" 
                                        action="{{ route('users.destroy', $parent) }}" 
                                        onsubmit="return confirm('Yakin ingin menghapus parent ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </td>                                
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">Module Terbaru</h3>
                        <a href="{{ route('modules.index') }}" 
                        class="text-purple-600 hover:text-purple-700 text-sm font-medium">Lihat Semua →</a>
                    </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentModules as $module)
                        <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group">
                            
                            @if($module->image_url)
                            <img src="{{ $module->image_url }}" 
                                alt="{{ $module->title }}" 
                                class="w-full h-48 object-cover">
                            @else
                            <div class="h-48 bg-gray-200 flex items-center justify-center text-6xl">
                                📖
                            </div>
                            @endif

                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-xs px-3 py-1 rounded-full 
                                        {{ $module->type === 'parent' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ ucfirst($module->type) }}
                                    </span>
                                </div>
                                
                                <h4 class="font-semibold line-clamp-2 mb-6 text-gray-800">{{ $module->title }}</h4>                                
                                <div class="flex gap-2">                                    
                                    <a href="{{ route('modules.show', $module) }}" 
                                    class="flex-1 flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-2xl text-sm font-medium transition">
                                        <span>👁</span>
                                        <span>Lihat</span>
                                    </a>                                    
                                    <a href="{{ route('modules.edit', $module) }}" 
                                    class="flex-1 flex items-center justify-center gap-2 bg-blue-100 hover:bg-blue-200 text-blue-700 py-3 rounded-2xl text-sm font-medium transition">
                                        <span>✏️</span>
                                        <span>Edit</span>
                                    </a>                                    
                                    <form action="{{ route('modules.destroy', $module) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Yakin ingin menghapus module ini beserta semua sub-babnya?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex-1 flex items-center justify-center gap-2 bg-red-100 hover:bg-red-200 text-red-700 py-3 rounded-2xl text-sm font-medium transition">
                                            <span>🗑</span>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-12">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">Article Terbaru</h3>
                        <a href="{{ route('articles.index') }}" 
                        class="text-purple-600 hover:text-purple-700 text-sm font-medium">Lihat Semua →</a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">                
                        @foreach($recentArticles as $article)
                        <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all border border-gray-100 flex flex-col">
                                                        
                            <div class="h-56 bg-gray-200 relative">
                                @if($article->image_url)
                                    <img src="{{ $article->image_url }}" 
                                        alt="{{ $article->title }}" 
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="h-full bg-gray-200 flex items-center justify-center text-6xl">
                                        📖
                                    </div>
                                @endif
                            </div>                        
                                                        
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center gap-2 text-emerald-600 text-xs font-medium mb-3">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                    {{ $article->created_at->diffForHumans() }}
                                </div>
                                
                                <h3 class="font-semibold text-gray-800 leading-tight mb-3 line-clamp-2">
                                    {{ $article->title }}
                                </h3>
                                
                                <p class="text-gray-600 text-sm line-clamp-3 mb-6 flex-1">
                                    {{ Str::limit(strip_tags($article->content), 160) }}
                                </p>
                                                                
                                <div class="flex gap-2 mt-auto pt-4 border-t">
                                    <a href="{{ route('articles.show', $article) }}" 
                                    class="flex-1 flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-2xl text-sm font-medium transition">
                                        <span>👁</span>
                                        <span>Lihat</span>
                                    </a>                                    
                                    
                                    <a href="{{ route('articles.edit', $article) }}" 
                                    class="flex-1 flex items-center justify-center gap-2 bg-blue-100 hover:bg-blue-200 text-blue-700 py-3 rounded-2xl text-sm font-medium transition">
                                        <span>✏️</span>
                                        <span>Edit</span>
                                    </a>                                    
                                    
                                    <form action="{{ route('articles.destroy', $article) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Yakin ingin menghapus article ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex-1 flex items-center justify-center gap-2 bg-red-100 hover:bg-red-200 text-red-700 py-3 rounded-2xl text-sm font-medium transition">
                                            <span>🗑</span>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="addParentModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">
                            <div class="bg-white rounded-3xl w-full max-w-md mx-4 overflow-hidden">
                                <div class="p-8">
                                    <h3 class="text-2xl font-bold mb-6">Tambah Parent Baru</h3>
                                    
                                    <form action="{{ route('users.store') }}" method="POST">
                                        @csrf
                                        
                                        <div class="mb-5">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                            <input type="text" name="name" required 
                                                class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                                        </div>

                                        <div class="mb-5">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                            <input type="email" name="email" required 
                                                class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                                        </div>

                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                            <input type="password" name="password" required 
                                                class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                                        </div>

                                        <div class="flex gap-3">
                                            <button type="button" onclick="hideAddParentModal()" 
                                                    class="flex-1 py-4 border border-gray-300 rounded-2xl font-medium">
                                                Batal
                                            </button>
                                            <button type="submit" 
                                                    class="flex-1 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-2xl">
                                                Tambahkan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>    
    <div id="addParentModal" class="hidden fixed inset-0 bg-black/60 flex items-center justify-center z-50">
        <div class="bg-white rounded-3xl w-full max-w-md mx-4">
            <div class="p-8">
                <h3 class="text-2xl font-bold mb-6">Tambah Parent Baru</h3>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" required class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" required class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password" name="password" required class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                        </div>
                    </div>

                    <div class="flex gap-3 mt-8">
                        <button type="button" onclick="hideAddParentModal()" 
                                class="flex-1 py-4 border border-gray-300 rounded-2xl font-medium">
                            Batal
                        </button>
                        <button type="submit" 
                                class="flex-1 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-2xl">
                            Tambahkan Parent
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showAddParentModal() {
            document.getElementById('addParentModal').classList.remove('hidden');
        }

        function hideAddParentModal() {
            document.getElementById('addParentModal').classList.add('hidden');
        }

        function deleteParent(){

        }

        document.getElementById('addParentModal').addEventListener('click', function(e) {
            if (e.target.id === 'addParentModal') hideAddParentModal();
        });
    </script>
</x-app-layout>