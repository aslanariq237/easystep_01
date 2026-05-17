<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-4xl mx-auto px-6">            

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800" id="page-title">
                        {{ isset($article) ? 'Edit Article' : 'Buat Article Baru' }}
                    </h1>
                    <p class="text-gray-500">
                        {{ isset($article) ? 'Perbarui artikel pembelajaran parenting' : 'Tambahkan artikel pembelajaran parenting' }}
                    </p>
                </div>
                <a href="{{ route('adminDashboard') }}" 
                   class="text-gray-500 hover:text-gray-700 flex items-center gap-2">
                    ← Kembali ke Dashboard
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8">

                <form action="{{ isset($article) ? route('articles.update', $article) : route('articles.store') }}" 
                      method="POST">

                    @csrf
                    @if(isset($article))
                        @method('PUT')
                    @endif
                                        
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Article</label>
                        <input type="text" 
                               name="title" 
                               value="{{ old('title', $article->title ?? '') }}"
                               class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:border-purple-500"
                               placeholder="Contoh: 5 Cara Menenangkan Anak Saat Tantrum" required>
                    </div>                                                        

                    <!-- Image URL -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Cover / Thumbnail (URL)</label>
                        <input type="url" 
                               name="image_url" 
                               value="{{ old('image_url', $article->image_url ?? '') }}"
                               placeholder="https://example.com/gambar-artikel.jpg" 
                               class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:border-purple-500">
                        <p class="text-xs text-gray-500 mt-1">Masukkan link gambar (Google, Unsplash, Pinterest, dll)</p>
                        
                        @if(isset($article) && $article->image_url)
                        <div class="mt-4">
                            <p class="text-sm text-gray-500 mb-2">Preview Gambar Saat Ini:</p>
                            <img src="{{ $article->image_url }}" 
                                 alt="Current Image" 
                                 class="h-48 object-cover rounded-xl border shadow-sm">
                        </div>
                        @endif
                    </div>
                    
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Artikel</label>
                        <textarea name="content" 
                                  rows="15"
                                  class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:border-purple-500"
                                  placeholder="Tulis isi artikel lengkap di sini...">{{ old('content', $article->content ?? '') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('adminDashboard') }}" 
                           class="px-8 py-4 border border-gray-300 rounded-2xl font-medium text-gray-600 hover:bg-gray-50">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-10 py-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-2xl transition">
                            {{ isset($article) ? 'Simpan Perubahan' : 'Simpan Article' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>