<x-app-layout>
    <div class="min-h-screen bg-gray-50 pb-20">
        
        <header class="text-white">            
            <div class="max-w-7xl mx-auto px-4 pt-6 pb-8">
                <div class="relative rounded-3xl overflow-hidden h-[260px] md:h-[320px]">
                    <img src="https://source.unsplash.com/random/1200x600/?mother,father,child" 
                         alt="Parenting Moment" 
                         class="absolute inset-0 w-full h-full object-cover">
                    
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                    
                    <div class="absolute inset-0 flex items-center px-6 md:px-12">
                        <div class="max-w-lg">
                            <h2 class="text-white text-3xl md:text-4xl font-bold leading-tight">
                                Your First Steps to Confident Parenting
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-4 -mt-6 relative z-10">            
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-3xl shadow-sm p-6 mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-2xl flex items-center justify-center text-2xl">👨‍👩</div>
                        <div>
                            <p class="font-semibold text-white">Parent's Progress</p>
                        </div>
                    </div>
                    <span class="text-slate-100 font-bold text-xl">{{ Auth::user()->parent_progress }}%</span>
                </div>
                <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500 rounded-full transition-all"
                         style="width: {{ Auth::user()->parent_progress }}%"></div>
                </div>
            </div>            
            <div class="mb-8">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-2xl font-bold text-gray-800">Articles</h2>
                    <div class="text-purple-600 text-sm font-medium flex items-center gap-1 cursor-pointer">
                        Semua Artikel <span class="text-lg">→</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($articles as $article)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all border border-gray-100">
                        <div class="h-56 bg-gray-200 relative">
                            <img src="{{ $article->image ? Storage::url($article->image) : 'https://source.unsplash.com/random/600x400/?parenting,child&sig=' . $article->id }}" 
                                 alt="{{ $article->title }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-emerald-600 text-xs font-medium mb-3">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                {{ $article->created_at->diffForHumans() }}
                            </div>
                            
                            <h3 class="font-semibold text-gray-800 leading-tight mb-3 line-clamp-2">
                                {{ $article->title }}
                            </h3>
                            
                            <p class="text-gray-600 text-sm line-clamp-3 mb-6">
                                {{ Str::limit(strip_tags($article->content), 160) }}
                            </p>
                            
                            <a href="{{ route('articles.show', $article->slug) }}" 
                               class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-2xl text-sm font-medium transition">
                                Read More 
                                <span class="text-lg leading-none">→</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>            
            {{-- <div>
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-2xl font-bold text-gray-800">Courses</h2>
                    <a href="{{ route('modules.index') }}" 
                       class="text-purple-600 text-sm font-medium flex items-center gap-1">
                        Lihat Semua <span class="text-lg">→</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">                    
                    <div class="bg-white rounded-3xl p-5 flex gap-5 shadow-sm hover:shadow transition border border-gray-100">
                        <div class="w-28 h-28 flex-shrink-0 bg-gray-200 rounded-2xl overflow-hidden">
                            <img src="https://source.unsplash.com/random/300x300/?toddler,learning" 
                                 alt="Course" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 mb-2 leading-tight">
                                Our Toddler's First Steps to Learning Made Easy
                            </h4>
                            <p class="text-gray-500 text-sm line-clamp-3">
                                Parenting doesn't come with a manual — but it can come with a guide...
                            </p>
                            <a href="#" 
                               class="mt-4 inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 font-medium text-sm">
                                Read More <span class="text-xl">→</span>
                            </a>
                        </div>
                    </div>                    
                    <div class="bg-white rounded-3xl p-5 flex gap-5 shadow-sm hover:shadow transition border border-gray-100">
                        <div class="w-28 h-28 flex-shrink-0 bg-gray-200 rounded-2xl overflow-hidden">
                            <img src="https://source.unsplash.com/random/300x300/?family,routine" 
                                 alt="Course" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 mb-2 leading-tight">
                                5 Simple Routines That Make Toddlers Feel Safe
                            </h4>
                            <p class="text-gray-500 text-sm line-clamp-3">
                                Consistency is key when raising happy little humans...
                            </p>
                            <a href="#" 
                               class="mt-4 inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 font-medium text-sm">
                                Read More <span class="text-xl">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}

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
                    <span class="text-[10px] mt-1 font-medium">Articles</span>
                </a>
                <a href="{{ route('forum.index') }}" class="flex flex-col items-center text-gray-500 hover:text-gray-700">
                    <span class="text-3xl">💬</span>
                    <span class="text-[10px] mt-1">Forum</span>
                </a>
            </div>
        </div>

    </div>
</x-app-layout>