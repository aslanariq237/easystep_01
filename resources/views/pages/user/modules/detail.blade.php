<x-app-layout>
    <div class="min-h-screen bg-gray-50">        
        <div class="bg-white border-b sticky top-0 z-50">
            <div class="max-w-4xl mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <a href="{{ route('modules.show', $module) }}" 
                       class="text-gray-500 hover:text-gray-700 flex items-center gap-2">
                        ← Kembali ke Module
                    </a>        
                    <div class="text-sm text-gray-500">
                        Sub-bab {{ $currentSection->order }} dari {{ $totalSections }}
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-4xl mx-auto px-4 py-10 mt-2">                        
            @if($currentSection->image_url)
            <div class="mb-10 rounded-3xl overflow-hidden shadow-sm">
                <img src="{{ $currentSection->image_url }}" 
                     alt="{{ $currentSection->title }}"
                     class="w-full h-auto">
            </div>
            @endif            
            <h1 class="text-3xl font-bold text-gray-800 mb-8">
                {{ $currentSection->title }}
            </h1>
            @if($currentSection->content)
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed mb-12">
                {!! nl2br(e($currentSection->content)) !!}
            </div>
            @endif            
            @if($currentSection->video_url)
            <div class="mb-12">
                <h3 class="font-semibold mb-4 text-gray-800">Video Pembelajaran</h3>
                @php
                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $currentSection->video_url, $matches);
                    $videoId = $matches[1] ?? str_replace('https://youtu.be/', '', $currentSection->video_url);
                @endphp
                
                <iframe width="100%" height="100%" 
                        src="https://www.youtube.com/embed/{{ $videoId }}" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                </iframe>
            </div>
            @endif 
            @if($currentSection->game_type)
                <iframe src="{{ asset('games/quiz/index.html') }}" 
                    width="100%" 
                    height="650" 
                    style="border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                </iframe>   
            @endif
            <div class="flex justify-between items-center mt-16 pt-8 border-t">
                @if($prevSection)
                    <a href="{{ route('module.detail', ['module' => $module, 'section' => $prevSection]) }}" 
                       class="flex items-center gap-2 text-gray-600 hover:text-purple-600">
                        ← Sub-bab Sebelumnya
                    </a>
                @else
                    <div></div>
                @endif
                @if($nextSection)
                    <a href="{{ route('module.detail', ['module' => $module, 'section' => $nextSection]) }}" 
                       class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-4 rounded-2xl font-medium flex items-center gap-2">
                        Sub-bab Selanjutnya →
                    </a>
                @else
                    <a href="{{ route('modules.show', $module) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-2xl font-medium">
                        Selesai Module ✓
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>