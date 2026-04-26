<x-app-layout>    
    <div class="min-h-screen bg-gray-50 pb-20">        
        <header class=" text-white">                        
            <div class="max-w-7xl mx-auto px-4 pt-6 pb-8">
                <div class="relative rounded-3xl overflow-hidden h-[260px] md:h-[320px]">
                    <img src="{{ asset('assets/kid_learn_4.jpg')}}" 
                         alt="childrening Moment" 
                         class="absolute inset-0 w-full h-full object-cover">
                    
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transchildren"></div>
                    
                    <div class="absolute inset-0 flex items-center px-6 md:px-12">
                        <div class="max-w-lg">
                            <h2 class="text-white text-3xl md:text-4xl font-bold leading-tight">
                                Your First Steps to Confident childrening
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="max-w-7xl mx-auto px-4 -mt-6 relative z-10">            
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-10">                
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-3xl shadow p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-2xl flex items-center justify-center text-2xl">👨‍👩</div>
                        <div class="flex-1">
                            <p class="font-semibold text-white">Progress Children</p>
                            <p class="text-sm text-gray-100">{{ Auth::user()->children_progress }}% selesai</p>
                        </div>
                    </div>
                    <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500 rounded-full transition-all" 
                            style="width: {{ Auth::user()->children_progress }}%"></div>
                    </div>
                </div>                
            </div>            
            <div class="mb-10">                

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($childrenModules as $module)
                    <div class="bg-white rounded-3xl overflow-hidden shadow hover:shadow-md transition border border-gray-100">
                        <div class="h-48 bg-gray-200 relative">
                            @if($module->image)
                            <img src="{{ asset('storage/' . $module->image) }}" 
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
                            <button onclick="window.location.href='{{ route('modules.show', ''.$module->id) }}'" 
                                    class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-2xl font-medium transition">
                                Lanjut Belajar →
                            </button>
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
