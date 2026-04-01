<x-app-layout>
    <div class="min-h-screen bg-gray-50">

        <!-- Top Navigation -->
        <div class="bg-white border-b sticky top-0 z-50">
            <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
                <a href="{{ route('module.indexParent') }}" 
                   class="flex items-center gap-2 text-gray-600 hover:text-purple-600 font-medium">
                    ← Kembali ke Daftar Modul
                </a>
                
                <div class="flex items-center gap-3">
                    <span class="px-4 py-1.5 text-xs font-semibold rounded-full 
                        {{ $module->type === 'parent' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                        {{ ucfirst($module->type) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4 py-8">

            <!-- Cover Image -->
            @if($module->image)
            <div class="rounded-3xl overflow-hidden shadow-sm mb-8">
                <img src="{{ asset('storage/' . $module->image) }}" 
                     alt="{{ $module->title }}"
                     class="w-full h-auto max-h-[420px] object-cover">
            </div>
            @endif

            <!-- Title & Description -->
            <div class="mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 leading-tight mb-4">
                    {{ $module->title }}
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed">
                    {{ $module->description }}
                </p>
            </div>

            <!-- Video Section -->
            @if($module->videos)
            <div class="mb-12">
                <h2 class="text-2xl font-semibold mb-5 flex items-center gap-3">
                    <span class="text-3xl">🎥</span>
                    Video Pembelajaran
                </h2>
                
                <div class="bg-black rounded-3xl overflow-hidden shadow-xl aspect-video">
                    <video controls class="w-full h-full" 
                           poster="{{ $module->image ? asset('storage/' . $module->image) : '' }}">
                        <source src="{{ asset('storage/' . $module->videos) }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutaran video.
                    </video>
                </div>
                
                <p class="text-xs text-gray-500 mt-3 text-center">
                    Video ini membantu Anda memahami materi dengan lebih baik
                </p>
            </div>
            @else
            <div class="bg-yellow-50 border border-yellow-200 rounded-3xl p-8 text-center mb-12">
                <span class="text-4xl mb-4 block">📹</span>
                <p class="text-gray-600">Video untuk module ini belum tersedia.</p>
            </div>
            @endif

            <!-- Content / Materi -->
            @if($module->content)
            <div class="bg-white rounded-3xl shadow-sm p-8 md:p-12">
                <h2 class="text-2xl font-semibold mb-6">Materi Pembelajaran</h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($module->content)) !!}
                </div>
            </div>
            @endif

            <!-- Progress Status -->
            <div class="mt-12 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-3xl p-8 border border-purple-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-600 font-medium">Status Progress</p>
                        <p class="text-3xl font-bold text-purple-700 mt-1">Module Ini Telah Diakses</p>
                    </div>
                    <div class="text-6xl">✅</div>
                </div>
            </div>

        </div>

        <!-- Bottom Navigation (Mobile) -->
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t md:hidden z-50">
            <div class="max-w-xl mx-auto grid grid-cols-4 py-2 text-center">
                <a href="{{ route('dashboard') }}" class="flex flex-col items-center text-gray-500 hover:text-gray-700">
                    <span class="text-3xl">🏠</span>
                    <span class="text-[10px] mt-1">Home</span>
                </a>
                <a href="{{ route('modules.index') }}" class="flex flex-col items-center text-purple-600">
                    <span class="text-3xl">📚</span>
                    <span class="text-[10px] mt-1 font-medium">Courses</span>
                </a>
                <a href="{{ route('articles.index') }}" class="flex flex-col items-center text-gray-500 hover:text-gray-700">
                    <span class="text-3xl">📖</span>
                    <span class="text-[10px] mt-1">Articles</span>
                </a>
                <a href="{{ route('forum.index') }}" class="flex flex-col items-center text-gray-500 hover:text-gray-700">
                    <span class="text-3xl">💬</span>
                    <span class="text-[10px] mt-1">Forum</span>
                </a>
            </div>
        </div>

    </div>
</x-app-layout>