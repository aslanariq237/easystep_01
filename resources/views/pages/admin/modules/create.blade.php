
<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-5xl mx-auto px-6">

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800" id="page-title">
                    {{ isset($module) ? 'Edit Module' : 'Buat Module Baru' }}
                </h1>
                <a href="{{ route('adminDashboard') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8">

                <form action="{{ isset($module) ? route('modules.update', $module) : route('modules.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      id="moduleForm">

                    @csrf
                    @if(isset($module))
                        @method('PUT')
                    @endif

                    <!-- Module Utama -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Module</label>
                            <input type="text" name="title" value="{{ old('title', $module->title ?? '') }}" required
                                   class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Module</label>
                            <select name="type" class="w-full border border-gray-300 rounded-2xl px-5 py-4" required>
                                <option value="parent" {{ old('type', $module->type ?? '') == 'parent' ? 'selected' : '' }}>Parent Module</option>
                                <option value="children" {{ old('type', $module->type ?? '') == 'children' ? 'selected' : '' }}>Children Module</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Cover (Opsional)</label>
                        <input type="file" 
                               name="image"
                               accept="image/jpeg,image/png,image/webp"
                               class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WebP. Maksimal 5MB</p>
                    </div>

                    <div class="mb-10">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Module</label>
                        <textarea name="description" rows="3" 
                                  class="w-full border border-gray-300 rounded-2xl px-5 py-4">{{ old('description', $module->description ?? '') }}</textarea>
                    </div>

                    <hr class="my-10">

                    <!-- Dynamic Sub-bab -->
                    <div id="sections-container">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-semibold">Sub-bab / Section</h2>
                            <button type="button" onclick="addSection()" 
                                    class="bg-purple-600 text-white px-6 py-3 rounded-2xl text-sm font-medium">
                                + Tambah Sub-bab
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 mt-12">
                        <a href="{{ route('adminDashboard') }}" 
                           class="px-8 py-4 border border-gray-300 rounded-2xl font-medium">Batal</a>
                        <button type="submit"
                                class="px-10 py-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-2xl">
                            Simpan Module
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let sectionCount = 0;

        function addSection(title = '', content = '', existingImage = '') {
            sectionCount++;
            const container = document.getElementById('sections-container');

            let imagePreview = '';
            if (existingImage) {
                imagePreview = `
                    <div class="mt-2">
                        <img src="${existingImage}" class="h-20 object-cover rounded border">
                    </div>`;
            }

            const html = `
                <div class="section-item border border-gray-200 rounded-3xl p-6 mb-6 bg-gray-50">
                    <div class="flex justify-between mb-4">
                        <h3 class="font-medium">Sub-bab <span class="section-number">${sectionCount}</span></h3>
                        <button type="button" onclick="removeSection(this)" 
                                class="text-red-600 hover:text-red-700 text-sm font-medium">Hapus</button>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Sub-bab</label>
                            <input type="text" name="sections[${sectionCount-1}][title]" value="${title}" required
                                   class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Isi Konten</label>
                            <textarea name="sections[${sectionCount-1}][content]" rows="5"
                                      class="w-full border border-gray-300 rounded-2xl px-5 py-4">${content}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                                <input type="file" name="sections[${sectionCount-1}][image]" accept="image/*" class="w-full">
                                ${imagePreview}
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Video</label>
                                <input type="file" name="sections[${sectionCount-1}][video]" accept="video/mp4,video/webm" class="w-full">
                            </div>
                        </div>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', html);
        }

        function removeSection(btn) {
            if (document.querySelectorAll('.section-item').length > 1) {
                btn.closest('.section-item').remove();
                updateSectionNumbers();
            }
        }

        function updateSectionNumbers() {
            document.querySelectorAll('.section-number').forEach((el, i) => {
                el.textContent = i + 1;
            });
        }

        // Initialize - tambah 1 section kosong saat create
        @if(!isset($module))
            window.onload = function() {
                addSection();
            };
        @endif

        // Jika mode Edit, isi data dari controller
        @if(isset($module) && isset($sections))
            @foreach($sections as $section)
                addSection(
                    "{{ addslashes($section->title ?? '') }}",
                    "{{ addslashes($section->content ?? '') }}",
                    "{{ $section->image ? asset('storage/' . $section->image) : '' }}"
                );
            @endforeach
        @endif
    </script>
</x-app-layout>
{{-- <x-app-layout>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-5xl mx-auto px-6">            
            <form action="{{ route('modules.store') }}" method="POST" enctype="multipart/form-data" id="moduleForm">
                @csrf
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Buat Module Baru</h1>
                        <p class="text-gray-500">Tambahkan module beserta beberapa sub-bab</p>
                    </div>
                    <div class="">
                        <a href="{{ route('adminDashboard') }}" class="text-gray-500 hover:text-gray-700 mr-2">← Kembali</a>
                        <button type="submit" class="px-10 py-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-2xl">
                            Simpan Module & Sub-bab
                        </button>
                    </div>                    
                </div>                
                <div class="bg-white rounded-3xl shadow-sm p-8">                                    
                    <!-- Module Utama -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Module</label>
                            <input type="text" name="title" required
                                   class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Module</label>
                            <select name="type" class="w-full border border-gray-300 rounded-2xl px-5 py-4" required>
                                <option value="parent">Parent Module (Orang Tua)</option>
                                <option value="children">Children Module (Anak)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-10">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Module</label>
                        <textarea name="content" rows="3" 
                                  class="w-full border border-gray-300 rounded-2xl px-5 py-4"></textarea>
                    </div>

                    <hr class="my-10 mb-2">

                    <!-- Dynamic Sub-bab -->
                    <div id="sections-container">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-semibold">Sub-bab / Section</h2>
                            <button type="button" onclick="addSection()" 
                                    class="bg-purple-600 text-white px-6 py-3 rounded-2xl text-sm font-medium">
                                + Tambah Sub-bab
                            </button>
                        </div>

                        <!-- Template Section -->
                        <div class="section-item border border-gray-200 rounded-3xl p-6 mb-6 bg-gray-50">
                            <div class="flex justify-between mb-4">
                                <h3 class="font-medium">Sub-bab <span class="section-number">1</span></h3>
                                <button type="button" onclick="removeSection(this)" 
                                        class="text-red-600 hover:text-red-700 text-sm font-medium">Hapus</button>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Sub-bab</label>
                                    <input type="text" name="sections[0][title]" required
                                           class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Isi Konten</label>
                                    <textarea name="sections[0][content]" rows="5"
                                              class="w-full border border-gray-300 rounded-2xl px-5 py-4"></textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                                        <input type="file" name="sections[0][image]" accept="image/*"
                                               class="w-full">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Video</label>
                                        <input type="file" name="sections[0][video]" accept="video/mp4,video/webm"
                                               class="w-full">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let sectionCount = 1;

        function addSection() {
            sectionCount++;
            const container = document.getElementById('sections-container');
            
            const newSection = document.createElement('div');
            newSection.className = 'section-item border border-gray-200 rounded-3xl p-6 mb-6 bg-gray-50';
            newSection.innerHTML = `
                <div class="flex justify-between mb-4">
                    <h3 class="font-medium">Sub-bab <span class="section-number">${sectionCount}</span></h3>
                    <button type="button" onclick="removeSection(this)" 
                            class="text-red-600 hover:text-red-700 text-sm font-medium">Hapus</button>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Sub-bab</label>
                        <input type="text" name="sections[${sectionCount-1}][title]" required
                               class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Konten</label>
                        <textarea name="sections[${sectionCount-1}][content]" rows="5"
                                  class="w-full border border-gray-300 rounded-2xl px-5 py-4"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                            <input type="file" name="sections[${sectionCount-1}][image]" accept="image/*"
                                   class="w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Video</label>
                            <input type="file" name="sections[${sectionCount-1}][video]" accept="video/mp4,video/webm"
                                   class="w-full">
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(newSection);
        }

        function removeSection(btn) {
            if (document.querySelectorAll('.section-item').length > 1) {
                btn.closest('.section-item').remove();
                // Update nomor section
                document.querySelectorAll('.section-number').forEach((el, i) => {
                    el.textContent = i + 1;
                });
            }
        }
    </script>
</x-app-layout>
{{-- <x-app-layout>
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
</x-app-layout> --}}