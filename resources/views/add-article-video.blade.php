<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Konten - OBESIFIT</title>
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
        body {
            overflow-x: hidden;
        }

        /* Content Card Hover */
        .content-card {
            transition: all 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(78, 172, 146, 0.15);
        }

        /* Tab Styles - Enhanced */
        .tab-button {
            transition: all 0.3s ease;
            position: relative;
        }

        .active-tab {
            background: linear-gradient(135deg, #4EAC92, #3A8C74);
            color: white;
            box-shadow: 0 4px 12px rgba(78, 172, 146, 0.3);
        }

        .tab-button:not(.active-tab):hover {
            background-color: rgba(78, 172, 146, 0.1);
            color: #4EAC92;
        }

        /* Form Input Styles */
        .form-input,
        .form-select {
            transition: all 0.3s ease;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: #4EAC92;
            box-shadow: 0 0 0 3px rgba(78, 172, 146, 0.1);
        }

        /* Drag & Drop Zone */
        .drag-over {
            border-color: #4EAC92;
            background: linear-gradient(135deg, rgba(78, 172, 146, 0.05), rgba(58, 140, 116, 0.05));
            transform: scale(1.02);
        }

        .drop-zone {
            transition: all 0.3s ease;
        }

        .drop-zone:hover {
            border-color: #4EAC92;
            background-color: rgba(78, 172, 146, 0.02);
        }

        /* Editor Content */
        .editor-content {
            min-height: 200px;
            max-height: 400px;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .editor-content:focus {
            outline: none;
            border-color: #4EAC92;
            box-shadow: 0 0 0 3px rgba(78, 172, 146, 0.1);
        }

        .editor-content:empty:before {
            content: attr(data-placeholder);
            color: #9CA3AF;
            pointer-events: none;
        }

        /* Sub-Content Card */
        .sub-content-card {
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Text Clamp */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Button Hover Effects */
        .btn-primary {
            background: linear-gradient(135deg, #4EAC92, #3A8C74);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(78, 172, 146, 0.3);
        }

        .btn-secondary {
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
        }

        /* Modal Animation */
        .modal {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .modal-content {
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Image Preview */
        .image-preview-wrapper {
            animation: fadeIn 0.3s ease;
        }

        /* Action Buttons */
        .action-btn {
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        /* Section Header */
        .section-header {
            position: relative;
            padding-left: 1rem;
        }

        .section-header::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 70%;
            background: linear-gradient(135deg, #4EAC92, #3A8C74);
            border-radius: 2px;
        }

        /* Empty State */
        .empty-state {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Scrollbar Styling */
        .editor-content::-webkit-scrollbar {
            width: 8px;
        }

        .editor-content::-webkit-scrollbar-track {
            background: #F3F4F6;
            border-radius: 4px;
        }

        .editor-content::-webkit-scrollbar-thumb {
            background: #4EAC92;
            border-radius: 4px;
        }

        .editor-content::-webkit-scrollbar-thumb:hover {
            background: #3A8C74;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-card:hover {
                transform: translateY(-4px);
            }
        }
    </style>
</head>

<body class="font-poppins bg-gradient-to-b from-gray-50 to-white">

    <!-- Include Navbar Component -->
    @auth
        @include('components.navbar-user')
    @endauth

    <!-- Hero Section - Enhanced -->
    <section class="bg-gradient-to-br from-primary via-secondary to-accent text-white pt-24 pb-12 md:pt-28 md:pb-16 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>
        
        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="inline-block mb-4">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto backdrop-blur-sm">
                    <i class="fas fa-edit text-3xl md:text-4xl"></i>
                </div>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight">Kelola Konten Edukasi</h1>
            <p class="text-base md:text-xl text-green-100 max-w-2xl mx-auto leading-relaxed">
                Buat dan kelola artikel serta video edukasi<br class="hidden md:block">
                untuk mendukung perjalanan sehat pengguna
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="py-8 md:py-12">
        <div class="container mx-auto px-4">

            <!-- Content Tabs - Enhanced -->
            <div class="bg-white rounded-2xl shadow-lg mb-8 overflow-hidden border border-gray-100">
                <!-- Tab Navigation -->
                <div class="flex space-x-2 bg-gray-100 p-2">
                    <button id="article-tab" class="tab-button active-tab flex-1 py-3 px-6 font-semibold rounded-xl transition-all">
                        <i class="fas fa-newspaper mr-2"></i>Kelola Artikel
                    </button>
                    <button id="video-tab" class="tab-button flex-1 py-3 px-6 font-semibold text-gray-600 rounded-xl transition-all">
                        <i class="fas fa-video mr-2"></i>Kelola Video
                    </button>
                </div>

                <!-- Article Form -->
                <div id="article-form" class="content-section p-6 md:p-8">
                    <form id="articleForm" action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Basic Info -->
                        <div class="mb-8">
                            <h3 class="section-header text-xl font-bold text-dark mb-6">Informasi Dasar</h3>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div class="lg:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-heading text-primary mr-2"></i>Judul Artikel
                                    </label>
                                    <input type="text" name="title" required
                                        class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                        placeholder="Masukkan judul artikel yang menarik">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-folder text-primary mr-2"></i>Kategori
                                    </label>
                                    <select name="category" required
                                        class="form-select w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition bg-white">
                                        <option value="Nutrition">Nutrition</option>
                                        <option value="Exercise">Exercise</option>
                                        <option value="Mental Health">Mental Health</option>
                                        <option value="Tips Sehat">Tips Sehat</option>
                                        <option value="Obesitas">Obesitas</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-clock text-primary mr-2"></i>Waktu Baca (menit)
                                    </label>
                                    <input type="number" name="read_time" required
                                        class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                        placeholder="Contoh: 5" min="1">
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <div class="mb-8">
                            <h3 class="section-header text-xl font-bold text-dark mb-6">Gambar Utama</h3>
                            <div id="imageDropZone"
                                class="drop-zone border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center cursor-pointer bg-gray-50">
                                <i class="fas fa-cloud-upload-alt text-4xl text-primary mb-3"></i>
                                <p class="text-gray-700 font-medium mb-2">Drag & drop gambar atau klik untuk upload</p>
                                <p class="text-sm text-gray-500">Format: JPG, PNG, GIF (Max. 5MB)</p>
                                <input type="file" id="imageUpload" name="featured_image" accept="image/*" class="hidden">
                            </div>
                            <div id="imagePreview" class="image-preview-wrapper mt-4 p-4 bg-gray-50 rounded-xl border-2 border-gray-200" style="display:none;">
                                <div class="flex items-center space-x-4">
                                    <img src="" alt="Preview" class="w-32 h-20 object-cover rounded-lg shadow-sm">
                                    <div class="flex-1">
                                        <p id="imageName" class="text-sm font-semibold text-gray-800"></p>
                                        <p id="imageSize" class="text-sm text-gray-500"></p>
                                    </div>
                                    <button type="button" class="action-btn text-red-500 hover:text-red-700 p-2" onclick="removeImagePreview()">
                                        <i class="fas fa-trash text-xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Sub-Contents -->
                        <div class="mb-8">
                            <h3 class="section-header text-xl font-bold text-dark mb-6">Konten Artikel</h3>
                            <div id="subContentsWrapper" class="space-y-4"></div>
                            <button type="button"
                                class="btn-secondary mt-4 px-5 py-2.5 bg-gray-100 text-primary rounded-xl font-semibold hover:bg-gray-200 border-2 border-gray-200"
                                onclick="addSubContent()">
                                <i class="fas fa-plus mr-2"></i>Tambah Sub-Content
                            </button>
                        </div>

                        <!-- Conclusion -->
                        <div class="mb-8">
                            <h3 class="section-header text-xl font-bold text-dark mb-6">Kesimpulan</h3>
                            <div class="border-2 border-gray-300 rounded-xl overflow-hidden">
                                <div class="editor-content p-4 focus:outline-none transition bg-white"
                                    contenteditable="true" data-name="conclusion"
                                    data-placeholder="Tulis kesimpulan artikel di sini..."></div>
                            </div>
                        </div>

                        <!-- Hidden Inputs -->
                        <input type="hidden" name="sub_contents" id="subContentsInput">
                        <input type="hidden" name="conclusion" id="conclusionInput">

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-6 border-t-2 border-gray-200">
                            <a href="{{ route('articles-videos') }}" class="btn-secondary px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn-primary px-6 py-3 text-white rounded-xl font-semibold">
                                <i class="fas fa-paper-plane mr-2"></i>Publikasikan Artikel
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Video Form -->
                <div id="video-form" class="content-section hidden p-6 md:p-8">
                    <form id="videoForm" action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Basic Info -->
                        <div class="mb-8">
                            <h3 class="section-header text-xl font-bold text-dark mb-6">Informasi Dasar</h3>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div class="lg:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-heading text-primary mr-2"></i>Judul Video
                                    </label>
                                    <input type="text" name="title" required
                                        class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                        placeholder="Masukkan judul video yang menarik">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-folder text-primary mr-2"></i>Kategori
                                    </label>
                                    <select name="category" required
                                        class="form-select w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition bg-white">
                                        <option value="Nutrition">Nutrition</option>
                                        <option value="Exercise">Exercise</option>
                                        <option value="Mental Health">Mental Health</option>
                                        <option value="Tips Sehat">Tips Sehat</option>
                                        <option value="Obesitas">Obesitas</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-clock text-primary mr-2"></i>Durasi (menit)
                                    </label>
                                    <input type="number" name="duration" required
                                        class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                        placeholder="Contoh: 10" min="1">
                                </div>
                            </div>
                        </div>

                        <!-- Thumbnail -->
                        <div class="mb-8">
                            <h3 class="section-header text-xl font-bold text-dark mb-6">Thumbnail Video</h3>
                            <div id="videoThumbnailDropZone"
                                class="drop-zone border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center cursor-pointer bg-gray-50">
                                <i class="fas fa-cloud-upload-alt text-4xl text-primary mb-3"></i>
                                <p class="text-gray-700 font-medium mb-2">Drag & drop gambar atau klik untuk upload</p>
                                <p class="text-sm text-gray-500">Format: JPG, PNG, GIF (Max. 5MB)</p>
                                <input type="file" id="videoThumbnailUpload" name="thumbnail" accept="image/*" class="hidden">
                            </div>
                            <div id="videoThumbnailPreview" class="image-preview-wrapper mt-4 p-4 bg-gray-50 rounded-xl border-2 border-gray-200" style="display:none;">
                                <div class="flex items-center space-x-4">
                                    <img src="" alt="Preview" class="w-32 h-20 object-cover rounded-lg shadow-sm">
                                    <div class="flex-1">
                                        <p id="videoThumbnailName" class="text-sm font-semibold text-gray-800"></p>
                                        <p id="videoThumbnailSize" class="text-sm text-gray-500"></p>
                                    </div>
                                    <button type="button" class="action-btn text-red-500 hover:text-red-700 p-2" onclick="removeVideoThumbnailPreview()">
                                        <i class="fas fa-trash text-xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Video URL -->
                        <div class="mb-8">
                            <h3 class="section-header text-xl font-bold text-dark mb-6">Link Video</h3>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-link text-primary mr-2"></i>URL Video
                            </label>
                            <input type="text" name="video_url" required
                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                placeholder="https://www.youtube.com/watch?v=...">
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <h3 class="section-header text-xl font-bold text-dark mb-6">Deskripsi</h3>
                            <textarea name="excerpt" rows="5" required
                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition resize-none"
                                placeholder="Ringkasan singkat tentang video ini..."></textarea>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-6 border-t-2 border-gray-200">
                            <a href="{{ route('articles-videos') }}" class="btn-secondary px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn-primary px-6 py-3 text-white rounded-xl font-semibold">
                                <i class="fas fa-paper-plane mr-2"></i>Publikasikan Video
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- My Articles Section -->
            <div class="bg-white rounded-2xl shadow-lg mb-8 p-6 md:p-8 border border-gray-100">
                <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
                    <h2 class="section-header text-2xl font-bold text-dark">
                        <i class="fas fa-newspaper text-primary mr-3"></i>
                        Artikel Saya
                    </h2>
                    @if ($articles->total() > 0)
                        <span class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-full text-sm font-semibold shadow-md">
                            <i class="fas fa-file-alt mr-2"></i>{{ $articles->total() }} Artikel
                        </span>
                    @endif
                </div>

                @if ($articles->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($articles as $article)
                            <div class="content-card bg-white border-2 border-gray-200 rounded-2xl overflow-hidden shadow-sm relative">
                                <div class="absolute top-3 right-3 z-10 flex gap-2">
                                    <button class="action-btn w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center text-blue-500 hover:text-blue-700 hover:shadow-lg"
                                        onclick="openEditModal({{ $article->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center text-red-500 hover:text-red-700 hover:shadow-lg"
                                        onclick="confirmDelete('article', {{ $article->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('img/dummy.jpg') }}"
                                    class="w-full h-48 object-cover">
                                <div class="p-5">
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="px-3 py-1 bg-primary bg-opacity-10 text-primary text-xs font-semibold rounded-full">
                                            {{ $article->category }}
                                        </span>
                                        <span class="text-gray-500 text-xs flex items-center">
                                            <i class="far fa-clock mr-1"></i>{{ $article->read_time }} min
                                        </span>
                                    </div>
                                    <h3 class="font-bold text-lg text-dark mb-2 line-clamp-2">{{ $article->title }}</h3>
                                    <p class="text-gray-600 text-sm line-clamp-3">{{ Str::limit($article->excerpt, 80) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $articles->links() }}
                    </div>
                @else
                    <div class="text-center py-16 empty-state">
                        <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg font-medium">Belum ada artikel yang kamu buat</p>
                        <p class="text-gray-400 text-sm mt-2">Mulai buat artikel pertamamu sekarang!</p>
                    </div>
                @endif
            </div>

            <!-- My Videos Section -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">
                <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
                    <h2 class="section-header text-2xl font-bold text-dark">
                        <i class="fas fa-video text-primary mr-3"></i>
                        Video Saya
                    </h2>
                    @if ($videos->total() > 0)
                        <span class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-full text-sm font-semibold shadow-md">
                            <i class="fas fa-play-circle mr-2"></i>{{ $videos->total() }} Video
                        </span>
                    @endif
                </div>

                @if ($videos->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($videos as $video)
                            <div class="content-card bg-white border-2 border-gray-200 rounded-2xl overflow-hidden shadow-sm relative">
                                <div class="absolute top-3 right-3 z-10">
                                    <button class="action-btn w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center text-red-500 hover:text-red-700 hover:shadow-lg"
                                        onclick="confirmDelete('video', {{ $video->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="relative">
                                    <img src="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : asset('img/dummy.jpg') }}"
                                        class="w-full h-48 object-cover">
                                    <div class="absolute top-3 left-3 bg-black bg-opacity-70 text-white px-2 py-1 rounded-lg text-xs font-medium">
                                        <i class="far fa-clock mr-1"></i>{{ $video->duration }}:00
                                    </div>
                                </div>
                                <div class="p-5">
                                    <span class="inline-block px-3 py-1 bg-primary bg-opacity-10 text-primary text-xs font-semibold rounded-full mb-3">
                                        {{ $video->category }}
                                    </span>
                                    <h3 class="font-bold text-lg text-dark mb-2 line-clamp-2">{{ $video->title }}</h3>
                                    <p class="text-gray-600 text-sm line-clamp-3">{{ Str::limit($video->excerpt, 80) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $videos->links() }}
                    </div>
                @else
                    <div class="text-center py-16 empty-state">
                        <i class="fas fa-video text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg font-medium">Belum ada video yang kamu buat</p>
                        <p class="text-gray-400 text-sm mt-2">Mulai buat video pertamamu sekarang!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center mr-2">
                            <i class="fas fa-heartbeat text-white"></i>
                        </div>
                        <span class="text-xl font-bold">OBESIFIT</span>
                    </div>
                    <p class="text-gray-400 mt-2">Platform Edukasi Obesitas Interaktif</p>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-gray-400">&copy; 2025 OBESIFIT. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="modal hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="modal-content bg-white rounded-2xl shadow-2xl p-8 w-96 max-w-md mx-4">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                </div>
                <h2 class="text-xl font-bold text-dark mb-2">Konfirmasi Hapus</h2>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus konten ini? Tindakan ini tidak dapat dibatalkan.</p>

                <div class="flex gap-3">
                    <button onclick="closeModal()" class="flex-1 px-4 py-3 rounded-xl bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button id="confirmDeleteBtn" class="flex-1 px-4 py-3 rounded-xl bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold hover:shadow-lg transition">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        let deleteType = null;
        let deleteId = null;

        function confirmDelete(type, id) {
            deleteType = type;
            deleteId = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            deleteType = null;
            deleteId = null;
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', async () => {
            if (!deleteType || !deleteId) return;

            const url = deleteType === 'article' ?
                `/articles/${deleteId}` :
                `/videos/${deleteId}`;

            try {
                const res = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });

                const data = await res.json();

                if (res.ok) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message || 'Gagal menghapus data');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan server');
            } finally {
                closeModal();
            }
        });

        // ================== Tab Switching ==================
        const articleTab = document.getElementById('article-tab');
        const videoTab = document.getElementById('video-tab');
        const articleForm = document.getElementById('article-form');
        const videoForm = document.getElementById('video-form');

        articleTab.addEventListener('click', () => {
            articleTab.classList.add('active-tab');
            articleTab.classList.remove('text-gray-600');
            videoTab.classList.remove('active-tab');
            videoTab.classList.add('text-gray-600');
            articleForm.classList.remove('hidden');
            videoForm.classList.add('hidden');
        });

        videoTab.addEventListener('click', () => {
            videoTab.classList.add('active-tab');
            videoTab.classList.remove('text-gray-600');
            articleTab.classList.remove('active-tab');
            articleTab.classList.add('text-gray-600');
            videoForm.classList.remove('hidden');
            articleForm.classList.add('hidden');
        });

        // ================== Article Image Upload ==================
        const imageDropZone = document.getElementById('imageDropZone');
        const imageUploadEl = document.getElementById('imageUpload');
        const imagePreviewEl = document.getElementById('imagePreview');
        const imgTag = imagePreviewEl.querySelector('img');
        const imgName = document.getElementById('imageName');
        const imgSize = document.getElementById('imageSize');

        imageDropZone.addEventListener('click', () => imageUploadEl.click());

        imageDropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageDropZone.classList.add('drag-over');
        });

        imageDropZone.addEventListener('dragleave', () => {
            imageDropZone.classList.remove('drag-over');
        });

        imageDropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            imageDropZone.classList.remove('drag-over');
            if (e.dataTransfer.files.length) {
                imageUploadEl.files = e.dataTransfer.files;
                handleImage(e.dataTransfer.files[0]);
            }
        });

        imageUploadEl.addEventListener('change', () => {
            if (imageUploadEl.files.length) handleImage(imageUploadEl.files[0]);
        });

        function handleImage(file) {
            if (!file.type.startsWith('image/')) {
                alert('File harus berupa gambar!');
                return;
            }
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file maksimal 5MB!');
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => {
                imgTag.src = e.target.result;
                imagePreviewEl.style.display = 'block';
                imgName.textContent = file.name;
                imgSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            };
            reader.readAsDataURL(file);
        }

        function removeImagePreview() {
            imageUploadEl.value = '';
            imagePreviewEl.style.display = 'none';
        }

        // ================== Video Thumbnail Upload ==================
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
            if (!file.type.startsWith('image/')) {
                alert('File harus berupa gambar!');
                return;
            }
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file maksimal 5MB!');
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => {
                videoImgTag.src = e.target.result;
                videoThumbnailPreviewEl.style.display = 'block';
                videoImgName.textContent = file.name;
                videoImgSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            };
            reader.readAsDataURL(file);
        }

        function removeVideoThumbnailPreview() {
            videoThumbnailUploadEl.value = '';
            videoThumbnailPreviewEl.style.display = 'none';
        }

        // ================== Sub-Content Management ==================
        let subContentIndex = 0;

        function addSubContent() {
            const wrapper = document.getElementById('subContentsWrapper');
            const div = document.createElement('div');
            div.className = 'sub-content-card border-2 border-gray-200 rounded-xl p-6 bg-gradient-to-br from-gray-50 to-white';
            div.setAttribute('data-index', subContentIndex++);
            div.innerHTML = `
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-dark flex items-center">
                        <i class="fas fa-paragraph text-primary mr-2"></i>
                        Sub-Content #${subContentIndex}
                    </h4>
                    <button type="button" class="action-btn px-3 py-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-sm font-semibold" onclick="this.parentElement.parentElement.remove()">
                        <i class="fas fa-trash mr-1"></i>Hapus
                    </button>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-heading text-primary mr-1"></i>Judul Sub-Content
                    </label>
                    <input type="text" class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition" placeholder="Masukkan judul...">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-primary mr-1"></i>Isi Sub-Content
                    </label>
                    <div class="editor-content p-4 border-2 border-gray-300 rounded-xl bg-white" contenteditable="true" data-name="subContent" data-placeholder="Tulis konten di sini..."></div>
                </div>
            `;
            wrapper.appendChild(div);
        }

        // Initialize with one sub-content
        window.addEventListener('DOMContentLoaded', () => addSubContent());

        // ================== Form Submit ==================
        document.getElementById('articleForm').addEventListener('submit', function(e) {
            const conclusion = document.querySelector('[data-name="conclusion"]').innerHTML.trim();

            const subContents = Array.from(document.querySelectorAll('#subContentsWrapper > div')).map((div, index) => ({
                title: div.querySelector('input').value,
                content: div.querySelector('[data-name="subContent"]').innerHTML.trim(),
                order: index
            }));

            // Validation
            if (!subContents.length || !subContents[0].title || !subContents[0].content) {
                e.preventDefault();
                alert('Minimal harus ada satu sub-content yang terisi!');
                return;
            }

            if (!conclusion) {
                e.preventDefault();
                alert('Kesimpulan tidak boleh kosong!');
                return;
            }

            document.getElementById('subContentsInput').value = JSON.stringify(subContents);
            document.getElementById('conclusionInput').value = conclusion;
        });

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>

</html>