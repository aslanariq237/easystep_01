<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-5xl mx-auto px-6">

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Edit Module</h1>
                <a href="{{ route('adminDashboard') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8">

                <form action="{{ route('modules.update', $module) }}" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      id="moduleForm">

                    @csrf
                    @method('PUT')

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
                        <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                        @if($module->image)
                        <div class="mt-4">
                            <p class="text-sm text-gray-500 mb-2">Gambar Saat Ini:</p>
                            <img src="{{ asset('storage/' . $module->image) }}" class="h-40 object-cover rounded-xl border">
                        </div>
                        @endif
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
                                + Tambah Sub-bab Baru
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 mt-12">
                        <a href="{{ route('adminDashboard') }}" 
                           class="px-8 py-4 border border-gray-300 rounded-2xl font-medium">Batal</a>
                        <button type="submit"
                                class="px-10 py-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-2xl">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let sectionCount = 0;

        function addSection(title = '', content = '', existingImage = '', hasImage = false, hasVideo = false, hasGame = false) {
            sectionCount++;
            const container = document.getElementById('sections-container');

            let imagePreview = existingImage ? 
                `<div class="mt-2"><img src="${existingImage}" class="h-24 object-cover rounded-xl border"></div>` : '';

            const html = `
                <div class="section-item border border-gray-200 rounded-3xl p-6 mb-6 bg-gray-50">
                    <div class="flex justify-between mb-4">
                        <h3 class="font-medium">Sub-bab <span class="section-number">${sectionCount}</span></h3>
                        <button type="button" onclick="removeSection(this)" class="text-red-600 hover:text-red-700 text-sm font-medium">Hapus</button>
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

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="flex items-center gap-2 mb-3">
                                    <input type="checkbox" class="has-image-check" onchange="toggleInput(this)" ${hasImage ? 'checked' : ''}>
                                    <span class="text-sm font-medium text-gray-700">Has Image</span>
                                </label>
                                <input type="file" name="images[${sectionCount-1}]" accept="image/*" 
                                       class="image-input w-full ${hasImage ? '' : 'hidden'}">
                                ${imagePreview}
                            </div>

                            <div>
                                <label class="flex items-center gap-2 mb-3">
                                    <input type="checkbox" class="has-video-check" onchange="toggleInput(this)" ${hasVideo ? 'checked' : ''}>
                                    <span class="text-sm font-medium text-gray-700">Has Video</span>
                                </label>
                                <input type="file" name="videos[${sectionCount-1}]" accept="video/mp4,video/webm" 
                                       class="video-input w-full ${hasVideo ? '' : 'hidden'}">
                            </div>

                            <div>
                                <label class="flex items-center gap-2 mb-3">
                                    <input type="checkbox" class="has-game-check" onchange="toggleInput(this)" ${hasGame ? 'checked' : ''}>
                                    <span class="text-sm font-medium text-gray-700">Has Game</span>
                                </label>
                                <select name="sections[${sectionCount-1}][game_type]" 
                                        class="game-input w-full border border-gray-300 rounded-2xl px-5 py-4 ${hasGame ? '' : 'hidden'}">
                                    <option value="">Pilih Game</option>
                                    <option value="quiz">Quiz</option>
                                    <option value="memory">Memory Match</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', html);
        }

        function toggleInput(checkbox) {
            const parent = checkbox.parentElement.parentElement;
            const input = parent.querySelector('input[type="file"], select');
            if (input) {
                input.classList.toggle('hidden', !checkbox.checked);
            }
        }

        function removeSection(btn) {
            if (document.querySelectorAll('.section-item').length > 1) {
                btn.closest('.section-item').remove();
                updateSectionNumbers();
            }
        }

        function updateSectionNumbers() {
            document.querySelectorAll('.section-number').forEach((el, i) => el.textContent = i + 1);
        }

        // Load existing sections
        @if(isset($module) && $module->sections && $module->sections->count() > 0)
            @foreach($module->sections as $section)
                addSection(
                    "{{ addslashes($section->title ?? '') }}",
                    {!! json_encode($section->content ?? '') !!},
                    "{{ $section->image ? asset('storage/' . $section->image) : '' }}",
                    {{ $section->has_image ? 'true' : 'false' }},
                    {{ $section->has_video ? 'true' : 'false' }},
                    {{ $section->has_game ? 'true' : 'false' }}
                );
            @endforeach
        @else
            window.onload = function() {
                addSection();
            };
        @endif
    </script>
</x-app-layout>