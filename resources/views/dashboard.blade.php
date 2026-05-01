<x-app-layout>    
    <div class="min-h-screen bg-gray-50 pb-20">        
        <header class=" text-white">            
            <div class="max-w-7xl mx-auto px-4 pt-6 pb-8">
                <div class="relative rounded-3xl overflow-hidden h-[260px] md:h-[320px]">
                    <img src="{{ asset('assets/kid_learn_1.jpg')}}" 
                         alt="Parenting Moment" 
                         class="absolute inset-0 w-full h-full object-cover">
                    
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                    
                    <div class="absolute inset-0 flex items-center px-6 md:px-12">
                        <div class="max-w-lg">
                            <h2 class="text-white text-3xl md:text-4xl font-bold leading-tight">
                                Karena setiap langkah kecil bermakna.
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-4 -mt-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
                <!-- Progress Orang Tua -->
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-3xl shadow p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-2xl flex items-center justify-center text-2xl">👨‍👩</div>
                        <div class="flex-1">
                            <p class="font-semibold text-white">Progress Orang Tua</p>
                            <p class="text-sm text-gray-100">{{ Auth::user()->parent_progress }}% selesai</p>
                        </div>
                    </div>
                    <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500 rounded-full transition-all" 
                            style="width: {{ Auth::user()->parent_progress }}%"></div>
                    </div>
                </div>                
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-3xl shadow p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-2xl flex items-center justify-center text-2xl">👶</div>
                        <div class="flex-1">
                            <p class="font-semibold text-white">Progress Anak</p>
                            <p class="text-sm text-gray-100">{{ Auth::user()->children_progress }}% selesai</p>
                        </div>
                    </div>
                    <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500 rounded-full transition-all" 
                            style="width: {{ Auth::user()->children_progress }}%"></div>
                        {{-- <div class="h-full w-[70%] bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full"></div> --}}
                    </div>
                </div>
            </div>            
            <div class="mb-10">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                        Lanjut di sini, yuk! <span class="text-2xl">🚀</span>
                    </h3>
                    <a href="{{ route('modules.index') }}" 
                       class="text-purple-600 hover:text-purple-700 text-sm font-medium flex items-center gap-1">
                        Lihat semua →
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($modules as $module)
                    <div class="bg-white rounded-3xl overflow-hidden shadow hover:shadow-md transition border border-gray-100">
                        <div class="h-48 bg-gray-200 relative">
                            @if($module->image)
                            <img src="{{ 
                                    (isset($module->image) && Storage::disk('public')->exists($module->image))
                                    ? asset('storage/' . $module->image) 
                                    : asset('assets/' . $module->image)
                                }}"  
                                alt="{{ $module->title }}" 
                                class="w-full h-full object-cover">
                            @else
                            <div class="h-48 bg-gray-200 flex items-center justify-center text-6xl">
                                📖
                            </div>
                            @endif
                            {{-- <img src="https://source.unsplash.com/random/400x300/?parenting,child&sig=" 
                                 alt="Course" class="w-full h-full object-cover"> --}}
                            <div class="absolute top-4 right-4 bg-white px-3 py-1 rounded-2xl text-xs font-semibold shadow {{ $module->type === 'parent' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $module->type }}
                            </div>
                        </div>
                        <div class="p-6">
                            <h4 class="font-semibold text-gray-800 line-clamp-2 mb-3">
                                {{ $module->title }}
                            </h4>
                            <p class="text-gray-500 text-sm line-clamp-2 mb-6">
                                Membantu orang tua memahami tahapan emosi dan cara mendukung anak dengan baik.
                            </p>
                            <button onclick="window.location.href='{{ route('modules.show',''.$module->id) }}'" 
                                    class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-2xl font-medium transition">
                                Lanjut Belajar →
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>            
            <div>
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                        Artikel Terbaru <span class="text-purple-500">📝</span>
                    </h3>
                    <a href="{{ route('articles.index') }}" 
                       class="text-purple-600 hover:text-purple-700 text-sm font-medium flex items-center gap-1">
                        Semua Artikel →
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($articles as $article)
                    <div class="bg-white rounded-3xl p-6 flex gap-5 hover:shadow transition border border-gray-100">
                        <div class="w-28 h-28 flex-shrink-0 bg-gray-200 rounded-2xl overflow-hidden">
                            @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" 
                                alt="{{ $article->title }}" 
                                class="w-full h-full object-cover">
                            @else
                            <div class="h-48 bg-gray-200 flex items-center justify-center text-6xl">
                                📖
                            </div>
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-2 text-emerald-600 text-xs font-medium mb-2">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                Baru
                            </div>
                            <h4 class="font-semibold leading-tight mb-3 line-clamp-2">
                                {{ $article->title }}
                            </h4>
                            <p class="text-gray-500 text-sm line-clamp-3 mb-4">
                                {{ Illuminate\Support\Str::limit($article->content, 50, '...') }}
                            </p>
                            <a href="{{ route('articles.show', $article->id) }}" 
                               class="text-purple-600 hover:text-purple-700 font-medium text-sm">
                                Baca Selengkapnya →
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>    
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t md:hidden z-50">
        <div class="max-w-xl mx-auto grid grid-cols-4 py-2 text-center">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center text-purple-600">
                <span class="text-3xl">🏠</span>
                <span class="text-[10px] mt-1 font-medium">Home</span>
            </a>
            <a href="{{ route('modules.index') }}" class="flex flex-col items-center text-gray-500 hover:text-gray-700">
                <span class="text-3xl">📚</span>
                <span class="text-[10px] mt-1 font-medium">Modul</span>
            </a>
            <a href="{{ route('articles.index') }}" class="flex flex-col items-center text-gray-500 hover:text-gray-700">
                <span class="text-3xl">📖</span>
                <span class="text-[10px] mt-1 font-medium">Artikel</span>
            </a>
            <a href="{{ route('forum.index') }}" class="flex flex-col items-center text-gray-500 hover:text-gray-700">
                <span class="text-3xl">💬</span>
                <span class="text-[10px] mt-1 font-medium">Forum</span>
            </a>
        </div>
    </div>
</x-app-layout>
