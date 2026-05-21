<x-app-layout>
    <div class="min-h-screen bg-gray-50 pb-20">
        <div class="max-w-4xl mx-auto px-4 py-10">            
            <div class="bg-white rounded-3xl shadow-sm p-8 mb-8">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="w-32 h-32 bg-gradient-to-br from-purple-500 to-indigo-500 text-white rounded-3xl flex items-center justify-center text-7xl shadow-inner">
                        👨‍👩‍👧
                    </div>
                    <div class="text-center md:text-left flex-1">
                        <h1 class="text-4xl font-bold text-gray-800">{{ $user->name }}</h1>
                        <p class="text-gray-500 mt-1">{{ $user->email }}</p>
                        {{-- <span class="inline-block mt-4 px-5 py-1.5 bg-purple-100 text-purple-700 text-sm font-medium rounded-full">
                            {{ ucfirst($user->role) }}
                        </span> --}}
                    </div>
                </div>
            </div>            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-3xl p-6 shadow-sm text-center">
                    <div class="text-4xl mb-2">📚</div>
                    <p class="text-3xl font-bold text-purple-600">{{ $totalModulesAccessed}}</p>
                    <p class="text-gray-600">Module Diakses</p>
                </div>
                {{-- <div class="bg-white rounded-3xl p-6 shadow-sm text-center">
                    <div class="text-4xl mb-2">📖</div>
                    <p class="text-3xl font-bold text-purple-600">8</p>
                    <p class="text-gray-600">Artikel Dibaca</p>
                </div> --}}
                <div class="bg-white rounded-3xl p-6 shadow-sm text-center">
                    <div class="text-4xl mb-2">💬</div>
                    <p class="text-3xl font-bold text-purple-600">{{ $totalForumPosts }}</p>
                    <p class="text-gray-600">Diskusi di Forum</p>
                </div>
            </div>            
            <div class="bg-white rounded-3xl shadow-sm p-8">
                <h3 class="text-xl font-semibold mb-6">Informasi Akun</h3>
                <div class="space-y-5">
                    <div class="flex justify-between py-3 border-b">
                        <span class="text-gray-600">Nama Lengkap</span>
                        <span class="font-medium">{{ $user->name }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b">
                        <span class="text-gray-600">Email</span>
                        <span class="font-medium">{{ $user->email }}</span>
                    </div>                    
                    <div class="flex justify-between py-3">
                        <span class="text-gray-600">Bergabung Sejak</span>
                        <span class="font-medium">{{ $user->created_at->format('d F Y') }}</span>
                    </div>
                </div>
            </div>            
            <div class="mt-8 flex gap-4">
                <a href="{{ route('profile.edit') }}" 
                   class="flex-1 text-center bg-purple-600 hover:bg-purple-700 text-white py-4 rounded-2xl font-medium transition">
                    ✏️ Edit Profil
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit"
                            onclick="return confirm('Yakin ingin logout?')"
                            class="w-full text-center border border-red-300 text-red-600 hover:bg-red-50 py-4 rounded-2xl font-medium transition">
                        🚪 Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>