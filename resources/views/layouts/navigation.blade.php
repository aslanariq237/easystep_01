<nav class="bg-gradient-to-r from-purple-600 to-indigo-600 border-b sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">            
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl flex items-center justify-center text-white font-bold text-2xl">
                    E
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">EasyStep</h1>
                    <p class="text-[10px] text-gray-200 -mt-1">Parenting Journey</p>
                </div>
            </div>            
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('dashboard') }}" 
                   class="text-white hover:text-gray-300 font-medium transition">Home</a>                
                <div class="relative group">
                    <button class="flex items-center gap-1 text-white hover:text-gray-300 font-medium transition delay-1000 hover:delay-0">
                        Modules
                        <span class="text-xs transition group-hover:rotate-180">▼</span>
                    </button>
                    
                    <!-- Dropdown Content -->
                    <div class="absolute left-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 hidden group-hover:block">
                        <a href="{{ route('module.indexParent') }}" 
                           class="flex items-center gap-3 px-5 py-3 hover:bg-purple-50 transition">
                            <span class="text-xl">👨‍👩</span>
                            <div>
                                <p class="font-medium text-gray-800">Parent Modules</p>
                                <p class="text-xs text-gray-500">Untuk Orang Tua</p>
                            </div>
                        </a>
                        <a href="{{ route('module.indexChildren') }}" 
                           class="flex items-center gap-3 px-5 py-3 hover:bg-blue-50 transition">
                            <span class="text-xl">👶</span>
                            <div>
                                <p class="font-medium text-gray-800">Children Modules</p>
                                <p class="text-xs text-gray-500">Untuk Anak</p>
                            </div>
                        </a>
                    </div>
                </div>

                <a href="{{ route('articles.index') }}" 
                   class="text-white hover:text-gray-300 font-medium transition">Articles</a>

                <a href="{{ route('forum.index') }}" 
                   class="text-white hover:text-gray-300 font-medium transition">Forum</a>
            </div>            
            <div class="flex items-center gap-4">                
                <div class="relative group">
                    <button class="flex items-center gap-3 focus:outline-none">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Parent' }}</p>
                            <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</p>
                        </div>
                        <div class="w-9 h-9 bg-purple-100 rounded-2xl flex items-center justify-center text-2xl border-2 border-white shadow">
                            👨‍👩‍👧
                        </div>
                    </button>                    
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 hidden group-hover:block">
                        <div class="px-5 py-3 border-b">
                            <p class="font-medium">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="#" class="block px-5 py-3 hover:bg-gray-50 text-sm">Profile Saya</a>
                        @if(Auth::user()->hasRole('admin'))
                            <a href="/admin-dashboard" class="block px-5 py-3 hover:bg-gray-50 text-sm">Admin Dashboard</a>
                        @endif
                        <a href="#" class="block px-5 py-3 hover:bg-gray-50 text-sm">Pengaturan</a>
                        <div class="border-t my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="block w-full text-left px-5 py-3 hover:bg-red-50 text-red-600 text-sm">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
        <div class="px-4 py-6 space-y-4">
            <a href="{{ route('dashboard') }}" class="block py-3 text-lg font-medium text-gray-700">Home</a>
            
            <div class="space-y-2">
                <p class="font-medium text-gray-500 px-1">Modules</p>
                <a href="{{ route('modules.index') }}" class="block pl-4 py-3 text-gray-700 flex items-center gap-3">
                    👨‍👩 Parent Modules
                </a>
                <a href="{{ route('modules.index') }}#children" class="block pl-4 py-3 text-gray-700 flex items-center gap-3">
                    👶 Children Modules
                </a>
            </div>

            <a href="{{ route('articles.index') }}" class="block py-3 text-lg font-medium text-gray-700">Articles</a>
            <a href="{{ route('forum.index') }}" class="block py-3 text-lg font-medium text-gray-700">Forum Diskusi</a>

            <div class="pt-6 border-t">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-red-600 py-3 font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>    
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>