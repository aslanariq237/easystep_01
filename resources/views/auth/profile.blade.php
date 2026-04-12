<x-app-layout>
    <div class="min-h-screen bg-gray-50 pb-20">

        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
            <div class="max-w-4xl mx-auto px-4 py-12 text-center">
                <div class="w-24 h-24 mx-auto bg-white rounded-3xl flex items-center justify-center text-6xl mb-6 shadow-lg">
                    👨‍👩‍👧
                </div>
                <h1 class="text-3xl font-bold">{{ Auth::user()->name }}</h1>
                <p class="text-purple-200 mt-1">Orang Tua</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 -mt-10 relative z-10">

            <!-- Profile Card -->
            <div class="bg-white rounded-3xl shadow-sm p-8 mb-8">
                <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
                    <div class="w-32 h-32 bg-gray-100 rounded-3xl flex items-center justify-center text-7xl flex-shrink-0">
                        👨‍👩‍👧
                    </div>
                    
                    <div class="flex-1 text-center md:text-left">
                        <h2 class="text-2xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                        <p class="text-gray-500">{{ Auth::user()->email }}</p>
                        
                        <div class="mt-6 grid grid-cols-2 gap-6 text-sm">
                            <div>
                                <p class="text-gray-500">Bergabung sejak</p>
                                <p class="font-medium">{{ Auth::user()->created_at->format('d F Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Status Akun</p>
                                <p class="font-medium text-green-600">Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Belajar -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-3xl p-6 shadow-sm">
                    <div class="text-4xl mb-3">📚</div>
                    <p class="text-3xl font-bold text-purple-600">{{ $totalModulesAccessed ?? 0 }}</p>
                    <p class="text-gray-600">Module Diakses</p>
                </div>
                
                <div class="bg-white rounded-3xl p-6 shadow-sm">
                    <div class="text-4xl mb-3">📖</div>
                    <p class="text-3xl font-bold text-purple-600">{{ $totalArticlesRead ?? 0 }}</p>
                    <p class="text-gray-600">Artikel Dibaca</p>
                </div>
                
                <div class="bg-white rounded-3xl p-6 shadow-sm">
                    <div class="text-4xl mb-3">💬</div>
                    <p class="text-3xl font-bold text-purple-600">{{ $totalForumPosts ?? 0 }}</p>
                    <p class="text-gray-600">Diskusi di Forum</p>
                </div>
            </div>

            <!-- Informasi Pribadi -->
            <div class="bg-white rounded-3xl shadow-sm p-8 mb-8">
                <h3 class="text-xl font-semibold mb-6">Informasi Pribadi</h3>
                
                <div class="space-y-6">
                    <div class="flex justify-between border-b pb-4">
                        <span class="text-gray-600">Nama Lengkap</span>
                        <span class="font-medium">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-4">
                        <span class="text-gray-600">Email</span>
                        <span class="font-medium">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-4">
                        <span class="text-gray-600">Role</span>
                        <span class="font-medium capitalize">{{ Auth::user()->role }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal Bergabung</span>
                        <span class="font-medium">{{ Auth::user()->created_at->format('d F Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Pengaturan -->
            <div class="bg-white rounded-3xl shadow-sm p-8">
                <h3 class="text-xl font-semibold mb-6">Pengaturan Akun</h3>
                
                <div class="space-y-4">
                    <a href="#" 
                       class="flex items-center justify-between p-5 hover:bg-gray-50 rounded-2xl transition">
                        <div class="flex items-center gap-4">
                            <span class="text-2xl">🔑</span>
                            <div>
                                <p class="font-medium">Ubah Password</p>
                                <p class="text-sm text-gray-500">Perbarui kata sandi akun Anda</p>
                            </div>
                        </div>
                        <span class="text-gray-400">→</span>
                    </a>

                    <a href="#" 
                       class="flex items-center justify-between p-5 hover:bg-gray-50 rounded-2xl transition">
                        <div class="flex items-center gap-4">
                            <span class="text-2xl">👤</span>
                            <div>
                                <p class="font-medium">Edit Profil</p>
                                <p class="text-sm text-gray-500">Ubah foto dan informasi pribadi</p>
                            </div>
                        </div>
                        <span class="text-gray-400">→</span>
                    </a>

                    <a href="#" 
                       class="flex items-center justify-between p-5 hover:bg-red-50 rounded-2xl transition text-red-600">
                        <div class="flex items-center gap-4">
                            <span class="text-2xl">🚪</span>
                            <div>
                                <p class="font-medium">Keluar Akun</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>

        <!-- Bottom Navigation -->
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
                <a href="{{ route('profile.show') }}" class="flex flex-col items-center text-purple-600">
                    <span class="text-3xl">👤</span>
                    <span class="text-[10px] mt-1 font-medium">Profil</span>
                </a>
            </div>
        </div>

    </div>
</x-app-layout>