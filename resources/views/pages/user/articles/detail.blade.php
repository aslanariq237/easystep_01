<x-app-layout>
    <div class="min-h-screen bg-gray-50">        
        <div class="bg-white border-b sticky top-0 z-50">
            <div class="max-w-4xl mx-auto px-4 py-4 flex items-center justify-between">
                <a href="{{ route('articles.index') }}" 
                   class="flex items-center gap-2 text-gray-600 hover:text-purple-600 font-medium">
                    ← Kembali ke Daftar Artikel
                </a>
                <span class="text-xs px-4 py-2 bg-purple-100 text-purple-700 rounded-full font-medium">
                    Artikel Parenting
                </span>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 py-10">            
            @if($article->image)
            <div class="rounded-3xl overflow-hidden shadow-md mb-10">
                <img src="{{ asset('storage/' . $article->image) }}" 
                     alt="{{ $article->title }}"
                     class="w-full h-auto max-h-[500px] object-cover">
            </div>
            @endif            
            <h1 class="text-4xl md:text-2xl font-bold text-gray-800 leading-tight mb-6">
                {{ $article->title }}
            </h1>            
            <div class="flex items-center gap-6 text-md text-gray-500 mb-10">
                <div class="flex items-center gap-2">
                    <span>👤</span>
                    <span>Ditulis oleh Admin</span>
                </div>
                <div>
                    {{ $article->created_at->format('d F Y') }}
                </div>
                {{-- <div class="flex items-center gap-2">
                    <span>⏱</span>
                    <span>{{ $article->reading_time ?? '8' }} menit baca</span>
                </div> --}}
            </div>            
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($article->content)) !!}
            </div>            
            <div class="mt-16 flex gap-4 border-t pt-8">
                <button onclick="window.history.back()" 
                        class="flex items-center gap-2 px-6 py-3 border border-gray-300 rounded-2xl hover:bg-gray-50 transition">
                    ← Kembali
                </button>
                
                <a href="{{ route('articles.index') }}" 
                   class="flex-1 text-center bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-2xl font-medium transition">
                    Lihat Artikel Lainnya
                </a>
            </div>

        </div>        
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
                <a href="{{ route('articles.index') }}" class="flex flex-col items-center text-purple-600">
                    <span class="text-3xl">📖</span>
                    <span class="text-[10px] mt-1 font-medium">Artikel</span>
                </a>
                <a href="{{ route('forum.index') }}" class="flex flex-col items-center text-gray-500 hover:text-gray-700">
                    <span class="text-3xl">💬</span>
                    <span class="text-[10px] mt-1">Forum</span>
                </a>
            </div>
        </div>

    </div>
</x-app-layout>