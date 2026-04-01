<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-4xl mx-auto px-6">            
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Buat Module Baru</h1>
                    <p class="text-gray-500">Tambahkan materi pembelajaran parenting</p>
                </div>
                <a href="{{ route('adminDashboard') }}" 
                   class="text-gray-500 hover:text-gray-700 flex items-center gap-2">
                    ← Kembali
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8">

                <form action="{{ route('modules.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Module</label>
                        <input type="text" 
                               name="title" 
                               value="{{ old('title') }}"
                               class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:border-purple-500"
                               placeholder="Contoh: Memahami Perkembangan Emosi Anak Usia 3-5 Tahun" required>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Module</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center gap-3 border border-gray-200 rounded-2xl p-4 cursor-pointer hover:border-purple-300 transition">
                                <input type="radio" name="type" value="parent" {{ old('type') === 'parent' ? 'checked' : '' }} class="w-5 h-5 text-purple-600">
                                <div>
                                    <p class="font-medium">Parent Module</p>
                                    <p class="text-xs text-gray-500">Untuk Orang Tua</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 border border-gray-200 rounded-2xl p-4 cursor-pointer hover:border-purple-300 transition">
                                <input type="radio" name="type" value="children" {{ old('type') === 'children' ? 'checked' : '' }} class="w-5 h-5 text-purple-600">
                                <div>
                                    <p class="font-medium">Children Module</p>
                                    <p class="text-xs text-gray-500">Untuk Anak</p>
                                </div>
                            </label>
                        </div>
                    </div>                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                        <textarea name="description" rows="3"
                                  class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:border-purple-500"
                                  placeholder="Deskripsi singkat tentang module ini...">{{ old('description') }}</textarea>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Materi / Konten</label>
                        <textarea name="content" rows="10"
                                  class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:border-purple-500"
                                  placeholder="Tulis materi lengkap di sini...">{{ old('content') }}</textarea>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Cover / Thumbnail</label>
                        <input type="file" 
                               name="image"
                               accept="image/*"
                               class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maksimal 5MB</p>
                    </div>
                    
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Video Pembelajaran (Opsional)</label>
                        <input type="file" 
                               name="video"
                               accept="video/mp4,video/webm"
                               class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">Format: MP4 atau WebM</p>
                    </div>                    
                    
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('adminDashboard') }}" 
                           class="px-8 py-4 border border-gray-300 rounded-2xl font-medium text-gray-600 hover:bg-gray-50">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-10 py-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-2xl transition">
                            Simpan Module
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>