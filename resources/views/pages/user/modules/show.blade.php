<x-app-layout>
    <div class="min-h-screen bg-gray-50">        
        <div class="bg-white border-b sticky top-0 z-50">
            <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
                <a href="{{ route('modules.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-purple-600">
                    ← Kembali ke Daftar Modul
                </a>
                <span class="px-4 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                    {{ ucfirst($module->type) }}
                </span>
            </div>
        </div>
        <div class="max-w-5xl mx-auto px-4 py-10">            
            @if($module->image)
            <div class="rounded-3xl overflow-hidden shadow-md mb-10">
                <img src="{{ asset('storage/' . $module->image) }}" 
                     alt="{{ $module->title }}"
                     class="w-full h-auto max-h-[450px] object-cover">
            </div>
            @endif                    
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 leading-tight mb-4">
                    {{ $module->title }}
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    {{ $module->description }}
                </p>
            </div>
            <div class="mt-10 bg-white rounded-3xl p-8 shadow-sm">
                <div class="flex justify-between items-center mb-3">
                    <p class="font-medium text-gray-700">Progress Pembelajaran</p>
                    <p class="font-semibold text-purple-600">{{ $progress }}%</p>
                </div>
                <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500 transition-all duration-300" 
                        style="width: {{ $progress }}%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-2 text-center">
                    {{ $module->sections->count() }} Sub-bab • {{ round($progress) }}% selesai
                </p>
            </div>         
            <div class="flex justify-center">
                <a href="{{ route('module.detail', $module) }}" 
                   class="inline-flex items-center gap-3 bg-purple-600 hover:bg-purple-700 text-white text-lg font-semibold px-2 py-5 rounded-3xl transition shadow-lg">
                    <span>Mulai / Lanjutkan Pembelajaran</span>
                    <span class="text-2xl">→</span>
                </a>
            </div>            
            <div class="text-center mt-6 text-gray-500 text-sm">
                Terdapat {{ $module->sections->count() ?? 0 }} sub-bab dalam module ini
            </div>

        </div>

    </div>
</x-app-layout>