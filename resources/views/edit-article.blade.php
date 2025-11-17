<!-- Edit Artikel Page -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel - OBESIFIT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4EAC92',
                        secondary: '#3A8C74',
                        accent: '#2C6B58',
                        dark: '#1F2937',
                        light: '#F9FAFB'
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        .content-card {
            transition: all 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-5px);
        }

        .active-tab {
            background-color: #4EAC92;
            color: white;
        }

        .drag-over {
            border: 2px dashed #4EAC92;
            background-color: #F0F9F6;
        }

        .editor-toolbar {
            border-bottom: 1px solid #E5E7EB;
            padding: 0.5rem;
            background: #F9FAFB;
        }

        .editor-content {
            min-height: 300px;
            border: 1px solid #E5E7EB;
            padding: 1rem;
            border-radius: 0 0 0.5rem 0.5rem;
        }

        .editor-content:empty:before {
            content: attr(data-placeholder);
            color: #9ca3af;
            pointer-events: none;
        }
    </style>
</head>

<body class="font-poppins bg-light">

    @auth
        @include('components.navbar-user')
    @endauth

    <section class="bg-gradient-to-br from-primary to-secondary text-white pt-24 pb-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Edit Artikel</h1>
            <p class="text-xl text-green-100 max-w-2xl mx-auto">Ubah artikel edukasi sesuai kebutuhan</p>
        </div>
    </section>

    <div class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">

            <!-- Form Edit Artikel -->
            <div class="bg-white rounded-2xl shadow-sm p-8">
                <form id="articleForm" action="{{ route('articles.update', $article->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Basic Info -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel</label>
                            <input type="text" name="title" value="{{ $article->title }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="Masukkan judul artikel yang menarik">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="category"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="Nutrition" {{ $article->category == 'Nutrition' ? 'selected' : '' }}>
                                    Nutrition</option>
                                <option value="Exercise" {{ $article->category == 'Exercise' ? 'selected' : '' }}>
                                    Exercise</option>
                                <option value="Mental Health"
                                    {{ $article->category == 'Mental Health' ? 'selected' : '' }}>Mental Health</option>
                                <option value="Tips Sehat" {{ $article->category == 'Tips Sehat' ? 'selected' : '' }}>
                                    Tips Sehat</option>
                                <option value="Obesitas" {{ $article->category == 'Obesitas' ? 'selected' : '' }}>
                                    Obesitas</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Baca (menit)</label>
                            <input type="number" name="read_time" value="{{ $article->read_time }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="Contoh: 5">
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
                        <div id="imageDropZone"
                            class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-primary transition cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                            <p class="text-gray-600 mb-2">Drag & drop gambar atau klik untuk upload</p>
                            <p class="text-sm text-gray-500">Format: JPG, PNG, GIF (Max. 5MB)</p>
                            <input type="file" id="imageUpload" name="featured_image" accept="image/*"
                                class="hidden">
                        </div>
                        <div id="imagePreview" class="mt-4 flex items-center space-x-4"
                            style="{{ $article->featured_image ? 'display:flex;' : 'display:none;' }}">
                            <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : '' }}"
                                alt="Preview" class="w-32 h-20 object-cover rounded-lg">
                            <div class="flex-1">
                                <p id="imageName" class="text-sm font-medium text-gray-700">
                                    {{ $article->featured_image ? basename($article->featured_image) : '' }}</p>
                                <p id="imageSize" class="text-sm text-gray-500"></p>
                            </div>
                            <button type="button" class="text-red-500 hover:text-red-700"
                                onclick="removeImagePreview()">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Sub-Contents -->
                    <div id="subContentsWrapper" class="mb-8">
                        <h3 class="text-lg font-semibold text-dark mb-4">Sub-Content</h3>
                        <!-- Akan diisi lewat JS -->
                    </div>
                    <button type="button"
                        class="mb-8 px-4 py-2 bg-primary text-white rounded-lg hover:bg-secondary transition"
                        onclick="addSubContent()">
                        <i class="fas fa-plus mr-2"></i>Tambah Sub-Content
                    </button>

                    <!-- Conclusion -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kesimpulan</label>
                        <div class="border border-gray-300 rounded-lg overflow-hidden">
                            <div class="editor-content p-4 border-t border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary relative"
                                contenteditable="true" data-name="excerpt">{!! $article->excerpt !!}</div>
                        </div>
                    </div>

                    <!-- Hidden Inputs -->
                    <input type="hidden" name="sub_contents" id="subContentsInput">
                    <input type="hidden" name="excerpt" id="conclusionInput">

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <button type="submit"
                            class="px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-secondary transition">
                            <i class="fas fa-paper-plane mr-2"></i>Perbarui Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS form handling sama seperti create article -->
    <script>
        let subContentIndex = 0;

        // ================== Tambah Sub-Content ==================
        function addSubContent(data = null) {
            const wrapper = document.getElementById('subContentsWrapper');
            const div = document.createElement('div');
            div.className = 'border border-gray-300 rounded-lg p-4 mb-4 bg-white';
            div.setAttribute('data-index', subContentIndex++);

            const titleValue = data?.title || '';
            const contentValue = data?.content || '';

            div.innerHTML = `
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Sub-Content</label>
            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="Judul Sub-Content" value="${titleValue}">
        </div>
        <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Isi Sub-Content</label>
            <div class="editor-content p-4 border border-gray-200 rounded-lg" contenteditable="true" data-name="subContent">${contentValue}</div>
        </div>
        <button type="button" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition" onclick="this.parentElement.remove()">
            <i class="fas fa-trash mr-1"></i>Hapus Sub-Content
        </button>
    `;
            wrapper.appendChild(div);
        }

        // ================== Preload Sub-Contents dari DB ==================
        const existingSubContents = @json($subContents);

        if (existingSubContents.length > 0) {
            existingSubContents.forEach(sc => addSubContent(sc));
        } else {
            window.addEventListener('DOMContentLoaded', () => addSubContent());
        }

        // ================== File Upload Gambar Utama ==================
        const imageDropZone = document.getElementById('imageDropZone');
        const imageUploadEl = document.getElementById('imageUpload');
        const imagePreviewEl = document.getElementById('imagePreview');
        const imgTag = imagePreviewEl.querySelector('img');
        const imgName = document.getElementById('imageName');
        const imgSize = document.getElementById('imageSize');

        imageDropZone.addEventListener('click', () => imageUploadEl.click());
        imageDropZone.addEventListener('dragover', e => {
            e.preventDefault();
            imageDropZone.classList.add('drag-over');
        });
        imageDropZone.addEventListener('dragleave', () => imageDropZone.classList.remove('drag-over'));
        imageDropZone.addEventListener('drop', e => {
            e.preventDefault();
            imageDropZone.classList.remove('drag-over');
            if (e.dataTransfer.files.length) {
                imageUploadEl.files = e.dataTransfer.files;
                handleImage(e.dataTransfer.files[0]);
            }
        });

        function handleImage(file) {
            if (!file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = e => {
                imgTag.src = e.target.result;
                imagePreviewEl.style.display = 'flex';
                imgName.textContent = file.name;
                imgSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            };
            reader.readAsDataURL(file);
        }

        imageUploadEl.addEventListener('change', () => {
            if (imageUploadEl.files.length) handleImage(imageUploadEl.files[0]);
        });

        function removeImagePreview() {
            imageUploadEl.value = '';
            imagePreviewEl.style.display = 'none';
        }

        // ================== Form Submit ==================
        document.getElementById('articleForm').addEventListener('submit', function(e) {
            // Ambil isi dari editor yang benar
            const conclusion = document.querySelector('[data-name="excerpt"]').innerHTML;

            const subContents = Array.from(document.querySelectorAll('#subContentsWrapper > div')).map((div,
                index) => ({
                    title: div.querySelector('input').value,
                    content: div.querySelector('[data-name="subContent"]').innerHTML,
                    order: index
                }));

            document.getElementById('subContentsInput').value = JSON.stringify(subContents);
            document.getElementById('conclusionInput').value = conclusion;
        });
    </script>

</body>

</html>
