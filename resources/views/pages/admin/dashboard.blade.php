<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        
        {{-- <nav class="bg-white border-b shadow-sm">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-purple-600 rounded-2xl flex items-center justify-center text-white font-bold text-2xl">
                        E
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">EasyStep</h1>
                        <p class="text-xs text-gray-500 -mt-1">Admin Panel</p>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <span class="text-sm font-medium text-gray-700">Halo, Admin</span>
                    <div class="w-9 h-9 bg-purple-100 rounded-2xl flex items-center justify-center text-2xl">
                        👨‍💼
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="text-red-600 hover:text-red-700 text-sm font-medium">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav> --}}

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
                    {{-- @foreach($recentModules as $module)
                        <div class="bg-white rounded-3xl overflow-hidden shadow-sm">
                            @if($module->image)
                            <img src="{{ asset('storage/' . $module->image) }}" 
                                alt="{{ $module->title }}" 
                                class="w-full h-48 object-cover">
                            @else
                            <div class="h-48 bg-gray-200 flex items-center justify-center text-6xl">
                                📖
                            </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-xs px-3 py-1 rounded-full {{ $module->type === 'parent' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ ucfirst($module->type) }}
                                    </span>
                                </div>
                                <h4 class="font-semibold line-clamp-2">{{ $module->title }}</h4>
                                <div class="flex gap-2">                                    
                                    <a href="{{ route('modules.show', $module) }}" 
                                    class="flex-1 text-center bg-gray-100 hover:bg-gray-400 text-gray-700 py-2.5 rounded-2xl text-sm font-medium transition">
                                        Lihat
                                    </a>                                    
                                    <a href="{{ route('modules.edit', $module) }}" 
                                    class="flex-1 text-center bg-blue-100 hover:bg-blue-200 text-blue-700 py-2.5 rounded-2xl text-sm font-medium transition">
                                        Edit
                                    </a>                                    
                                    <form action="{{ route('modules.destroy', $module) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Yakin ingin menghapus module ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex-1 bg-red-100 hover:bg-red-400 text-red-700 py-2.5 rounded-2xl text-sm font-medium transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>