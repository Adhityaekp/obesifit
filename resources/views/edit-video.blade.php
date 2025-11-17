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
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Edit Video Edukasi</h1>
            <p class="text-xl text-green-100 max-w-2xl mx-auto">Ubah detail video edukasi Anda</p>
        </div>
    </section>

    <div class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-sm p-8">
                <form id="videoEditForm" action="{{ route('videos.update', $video->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Basic Info -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Video</label>
                            <input type="text" name="title" value="{{ $video->title }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"
                                placeholder="Masukkan judul video">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="category"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
                                @foreach (['Nutrition', 'Exercise', 'Mental Health', 'Tips Sehat', 'Obesitas'] as $cat)
                                    <option value="{{ $cat }}"
                                        {{ $video->category == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Durasi (menit)</label>
                            <input type="number" name="duration" value="{{ $video->duration }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"
                                placeholder="Contoh: 10">
                        </div>
                    </div>

                    <!-- Thumbnail -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Thumbnail Video</label>
                        <div id="videoThumbnailDropZone"
                            class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-primary transition cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                            <p class="text-gray-600 mb-2">Drag & drop gambar atau klik untuk upload</p>
                            <p class="text-sm text-gray-500">Format: JPG, PNG, GIF (Max. 2MB)</p>
                            <input type="file" id="videoThumbnailUpload" name="thumbnail" accept="image/*"
                                class="hidden">
                        </div>

                        <div id="videoThumbnailPreview" class="mt-4 flex items-center space-x-4"
                            style="{{ $video->thumbnail ? 'display:flex;' : 'display:none;' }}">
                            <img src="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : '' }}"
                                alt="Preview" class="w-32 h-20 object-cover rounded-lg">
                            <div class="flex-1">
                                <p id="videoThumbnailName" class="text-sm font-medium text-gray-700">
                                    {{ $video->thumbnail ? basename($video->thumbnail) : '' }}</p>
                                <p id="videoThumbnailSize" class="text-sm text-gray-500"></p>
                            </div>
                            <button type="button" class="text-red-500 hover:text-red-700"
                                onclick="removeVideoThumbnailPreview()">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Video URL -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Link / URL Video</label>
                        <input type="text" name="video_url" value="{{ $video->video_url }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"
                            placeholder="Masukkan link video YouTube atau path video">
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Video</label>
                        <textarea name="excerpt" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"
                            placeholder="Ringkasan singkat video">{{ $video->excerpt }}</textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <button type="submit"
                            class="px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-secondary transition">
                            <i class="fas fa-save mr-2"></i>Perbarui Video
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const videoThumbnailDropZone = document.getElementById('videoThumbnailDropZone');
        const videoThumbnailUploadEl = document.getElementById('videoThumbnailUpload');
        const videoThumbnailPreviewEl = document.getElementById('videoThumbnailPreview');
        const videoImgTag = videoThumbnailPreviewEl.querySelector('img');
        const videoImgName = document.getElementById('videoThumbnailName');
        const videoImgSize = document.getElementById('videoThumbnailSize');

        videoThumbnailDropZone.addEventListener('click', () => videoThumbnailUploadEl.click());

        videoThumbnailDropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            videoThumbnailDropZone.classList.add('drag-over');
        });
        videoThumbnailDropZone.addEventListener('dragleave', () => {
            videoThumbnailDropZone.classList.remove('drag-over');
        });
        videoThumbnailDropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            videoThumbnailDropZone.classList.remove('drag-over');
            if (e.dataTransfer.files.length) {
                videoThumbnailUploadEl.files = e.dataTransfer.files;
                handleVideoThumbnail(e.dataTransfer.files[0]);
            }
        });

        videoThumbnailUploadEl.addEventListener('change', () => {
            if (videoThumbnailUploadEl.files.length) handleVideoThumbnail(videoThumbnailUploadEl.files[0]);
        });

        function handleVideoThumbnail(file) {
            if (!file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                videoImgTag.src = e.target.result;
                videoThumbnailPreviewEl.style.display = 'flex';
                videoImgName.textContent = file.name;
                videoImgSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            };
            reader.readAsDataURL(file);
        }

        function removeVideoThumbnailPreview() {
            videoThumbnailUploadEl.value = '';
            videoThumbnailPreviewEl.style.display = 'none';
        }
    </script>

</body>


</html>
