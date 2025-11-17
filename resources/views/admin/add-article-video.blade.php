<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Konten - OBESIFIT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
        .content-section {
            transition: all 0.3s ease;
        }
        
        .tab-active {
            background: linear-gradient(135deg, #4EAC92, #3A8C74);
            color: white;
        }
        
        .tab-inactive {
            background: #F9FAFB;
            color: #6B7280;
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
        
        .video-chapter {
            transition: all 0.3s ease;
        }
        
        .video-chapter:hover {
            background-color: #F9FAFB;
        }
    </style>
</head>

<body class="font-poppins bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm fixed w-full top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center mr-2">
                            <i class="fas fa-heartbeat text-white"></i>
                        </div>
                        <span class="text-xl font-bold text-dark">OBESIFIT</span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="/admin/dashboard" class="text-dark hover:text-primary transition">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <button class="flex items-center space-x-2 text-dark hover:text-primary transition">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span>Admin</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-20 pb-8">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-dark mb-2">Kelola Konten</h1>
                <p class="text-gray-600">Tambah atau edit artikel dan video edukasi</p>
            </div>

            <!-- Content Type Tabs -->
            <div class="bg-white rounded-2xl shadow-sm mb-8">
                <div class="flex border-b border-gray-200">
                    <button id="article-tab" class="tab-active flex-1 py-4 px-6 font-semibold rounded-tl-2xl transition-all">
                        <i class="fas fa-newspaper mr-2"></i>Artikel
                    </button>
                    <button id="video-tab" class="tab-inactive flex-1 py-4 px-6 font-semibold rounded-tr-2xl transition-all">
                        <i class="fas fa-video mr-2"></i>Video
                    </button>
                </div>

                <!-- Article Form -->
                <div id="article-form" class="content-section p-6">
                    <form id="articleForm">
                        <!-- Basic Information -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                            <!-- Title -->
                            <div class="lg:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel</label>
                                <input type="text" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                       placeholder="Masukkan judul artikel yang menarik"
                                       value="10 Pola Makan Sehat untuk Keluarga">
                            </div>

                            <!-- Category & Read Time -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="nutrition" selected>Nutrition</option>
                                    <option value="exercise">Exercise</option>
                                    <option value="mental-health">Mental Health</option>
                                    <option value="wellness">Wellness</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Baca</label>
                                <input type="text" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                       placeholder="Contoh: 5 min read"
                                       value="5 min read">
                            </div>

                            <!-- Author -->
                            <div class="lg:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1">
                                        <input type="text" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                               placeholder="Nama penulis"
                                               value="Dr. Sarah Wijaya">
                                    </div>
                                    <div class="flex-1">
                                        <input type="text" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                               placeholder="Posisi/Spesialisasi"
                                               value="Ahli Gizi & Nutritionist">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-primary transition cursor-pointer"
                                 id="imageDropZone">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                <p class="text-gray-600 mb-2">Drag & drop gambar atau klik untuk upload</p>
                                <p class="text-sm text-gray-500">Format: JPG, PNG, GIF (Max. 5MB)</p>
                                <input type="file" class="hidden" id="imageUpload" accept="image/*">
                            </div>
                            <div class="mt-4 flex items-center space-x-4" id="imagePreview">
                                <img src="/img/article-detail-1.jpg" alt="Preview" class="w-32 h-20 object-cover rounded-lg">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-700">article-detail-1.jpg</p>
                                    <p class="text-sm text-gray-500">1.2 MB</p>
                                </div>
                                <button type="button" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Content Editor -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konten Artikel</label>
                            <div class="border border-gray-300 rounded-lg overflow-hidden">
                                <!-- Toolbar -->
                                <div class="editor-toolbar flex items-center space-x-2">
                                    <button type="button" class="p-2 hover:bg-gray-200 rounded" title="Bold">
                                        <i class="fas fa-bold"></i>
                                    </button>
                                    <button type="button" class="p-2 hover:bg-gray-200 rounded" title="Italic">
                                        <i class="fas fa-italic"></i>
                                    </button>
                                    <button type="button" class="p-2 hover:bg-gray-200 rounded" title="Heading">
                                        <i class="fas fa-heading"></i>
                                    </button>
                                    <button type="button" class="p-2 hover:bg-gray-200 rounded" title="List">
                                        <i class="fas fa-list"></i>
                                    </button>
                                    <button type="button" class="p-2 hover:bg-gray-200 rounded" title="Link">
                                        <i class="fas fa-link"></i>
                                    </button>
                                    <button type="button" class="p-2 hover:bg-gray-200 rounded" title="Image">
                                        <i class="fas fa-image"></i>
                                    </button>
                                </div>
                                
                                <!-- Editor -->
                                <div class="editor-content">
                                    <p class="text-lg text-gray-700 font-medium mb-4">
                                        Menerapkan pola makan sehat untuk seluruh keluarga tidak harus rumit.
                                        Dengan tips praktis berikut, Anda bisa memulai perubahan kecil yang
                                        berdampak besar bagi kesehatan keluarga.
                                    </p>

                                    <h2 class="text-xl font-bold text-dark mb-3">1. Mulai dengan Sarapan Bergizi</h2>
                                    <p class="mb-4">
                                        Sarapan adalah fondasi hari yang produktif. Pastikan menu sarapan
                                        mengandung protein, karbohidrat kompleks, dan serat.
                                    </p>

                                    <ul class="list-disc list-inside mb-4">
                                        <li>Oatmeal dengan buah-buahan dan kacang-kacangan</li>
                                        <li>Telur rebus dengan roti gandum dan sayuran</li>
                                        <li>Smoothie bowl dengan yogurt dan biji chia</li>
                                    </ul>

                                    <blockquote class="border-l-4 border-primary pl-4 italic text-gray-600 mb-4">
                                        "Sarapan yang baik tidak hanya memberikan energi, tapi juga
                                        membantu mengontrol nafsu makan sepanjang hari."
                                    </blockquote>

                                    <!-- Continue with more content... -->
                                </div>
                            </div>
                        </div>

                        <!-- SEO Settings -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-dark mb-4">Pengaturan SEO</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                                    <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" rows="3"
                                              placeholder="Deskripsi singkat untuk mesin pencari">Temukan cara mudah menerapkan pola makan sehat untuk seluruh keluarga tanpa ribet. Tips praktis yang bisa langsung diaplikasikan.</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Keywords</label>
                                    <input type="text" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                           placeholder="Pisahkan dengan koma"
                                           value="pola makan sehat, keluarga, nutrisi, tips kesehatan">
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" checked>
                                    <span class="text-sm text-gray-700">Publikasikan langsung</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="text-sm text-gray-700">Izinkan komentar</span>
                                </label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <button type="button" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                                    Simpan Draft
                                </button>
                                <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-secondary transition">
                                    Publikasikan Artikel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Video Form -->
                <div id="video-form" class="content-section hidden p-6">
                    <form id="videoForm">
                        <!-- Basic Information -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                            <!-- Title -->
                            <div class="lg:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Video</label>
                                <input type="text" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                       placeholder="Masukkan judul video yang menarik"
                                       value="5 Pola Makan Sehat untuk Pemula yang Mudah Dipraktikkan">
                            </div>

                            <!-- Category & Duration -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="nutrition" selected>Nutrition</option>
                                    <option value="exercise">Exercise</option>
                                    <option value="mental-health">Mental Health</option>
                                    <option value="wellness">Wellness</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Durasi Video</label>
                                <input type="text" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                       placeholder="Contoh: 8:15"
                                       value="8:15">
                            </div>

                            <!-- Video URL & Thumbnail -->
                            <div class="lg:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">URL Video</label>
                                <input type="url" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                       placeholder="https://youtube.com/embed/..."
                                       value="https://www.youtube.com/embed/dQw4w9WgXcQ">
                            </div>
                        </div>

                        <!-- Thumbnail Upload -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Thumbnail Video</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-primary transition cursor-pointer"
                                 id="thumbnailDropZone">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                <p class="text-gray-600 mb-2">Drag & drop thumbnail atau klik untuk upload</p>
                                <p class="text-sm text-gray-500">Format: JPG, PNG (Max. 2MB)</p>
                                <input type="file" class="hidden" id="thumbnailUpload" accept="image/*">
                            </div>
                            <div class="mt-4 flex items-center space-x-4" id="thumbnailPreview">
                                <img src="/img/video-thumbnail-1.jpg" alt="Preview" class="w-32 h-20 object-cover rounded-lg">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-700">video-thumbnail-1.jpg</p>
                                    <p class="text-sm text-gray-500">0.8 MB</p>
                                </div>
                                <button type="button" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Video Chapters -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-4">Chapter Video</label>
                            <div class="space-y-3" id="chaptersContainer">
                                <!-- Chapter 1 -->
                                <div class="video-chapter flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                                    <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Waktu Mulai</label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-primary" value="00:00">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-xs text-gray-500 mb-1">Judul Chapter</label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-primary" value="Pengenalan">
                                        </div>
                                    </div>
                                    <button type="button" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <!-- Chapter 2 -->
                                <div class="video-chapter flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                                    <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Waktu Mulai</label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-primary" value="02:15">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-xs text-gray-500 mb-1">Judul Chapter</label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-primary" value="Pola Makan 1: Porsi">
                                        </div>
                                    </div>
                                    <button type="button" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <button type="button" class="mt-3 flex items-center space-x-2 text-primary hover:text-secondary transition">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Chapter</span>
                            </button>
                        </div>

                        <!-- Video Description -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Video</label>
                            <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" rows="4"
                                      placeholder="Jelaskan tentang video ini...">Dalam video ini, Anda akan mempelajari 5 pola makan sehat dasar yang mudah diterapkan untuk pemula. Mulai dari perubahan kecil yang bisa dilakukan mulai hari ini untuk kesehatan yang lebih baik.</textarea>
                        </div>

                        <!-- Download Materials -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-4">Materi Unduhan</label>
                            <div class="space-y-3" id="materialsContainer">
                                <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Nama File</label>
                                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-primary" value="Cheat Sheet Pola Makan.pdf">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Tipe File</label>
                                            <select class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-primary">
                                                <option value="pdf">PDF</option>
                                                <option value="excel">Excel</option>
                                                <option value="word">Word</option>
                                                <option value="image">Gambar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="button" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <button type="button" class="mt-3 flex items-center space-x-2 text-primary hover:text-secondary transition">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Materi</span>
                            </button>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" checked>
                                    <span class="text-sm text-gray-700">Publikasikan langsung</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" checked>
                                    <span class="text-sm text-gray-700">Izinkan komentar</span>
                                </label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <button type="button" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                                    Simpan Draft
                                </button>
                                <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-secondary transition">
                                    Publikasikan Video
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab Switching
        const articleTab = document.getElementById('article-tab');
        const videoTab = document.getElementById('video-tab');
        const articleForm = document.getElementById('article-form');
        const videoForm = document.getElementById('video-form');

        function switchToArticle() {
            articleTab.classList.remove('tab-inactive');
            articleTab.classList.add('tab-active');
            videoTab.classList.remove('tab-active');
            videoTab.classList.add('tab-inactive');
            articleForm.classList.remove('hidden');
            videoForm.classList.add('hidden');
        }

        function switchToVideo() {
            videoTab.classList.remove('tab-inactive');
            videoTab.classList.add('tab-active');
            articleTab.classList.remove('tab-active');
            articleTab.classList.add('tab-inactive');
            videoForm.classList.remove('hidden');
            articleForm.classList.add('hidden');
        }

        articleTab.addEventListener('click', switchToArticle);
        videoTab.addEventListener('click', switchToVideo);

        // File Upload Handling
        const imageDropZone = document.getElementById('imageDropZone');
        const imageUpload = document.getElementById('imageUpload');
        const thumbnailDropZone = document.getElementById('thumbnailDropZone');
        const thumbnailUpload = document.getElementById('thumbnailUpload');

        // Image Upload
        imageDropZone.addEventListener('click', () => imageUpload.click());
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
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleImageUpload(files[0]);
            }
        });

        // Thumbnail Upload
        thumbnailDropZone.addEventListener('click', () => thumbnailUpload.click());
        thumbnailDropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            thumbnailDropZone.classList.add('drag-over');
        });
        thumbnailDropZone.addEventListener('dragleave', () => {
            thumbnailDropZone.classList.remove('drag-over');
        });
        thumbnailDropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            thumbnailDropZone.classList.remove('drag-over');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleThumbnailUpload(files[0]);
            }
        });

        function handleImageUpload(file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const preview = document.getElementById('imagePreview');
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="w-32 h-20 object-cover rounded-lg">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-700">${file.name}</p>
                            <p class="text-sm text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                        </div>
                        <button type="button" class="text-red-500 hover:text-red-700" onclick="removeImagePreview()">
                            <i class="fas fa-trash"></i>
                        </button>
                    `;
                };
                reader.readAsDataURL(file);
            }
        }

        function handleThumbnailUpload(file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const preview = document.getElementById('thumbnailPreview');
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="w-32 h-20 object-cover rounded-lg">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-700">${file.name}</p>
                            <p class="text-sm text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                        </div>
                        <button type="button" class="text-red-500 hover:text-red-700" onclick="removeThumbnailPreview()">
                            <i class="fas fa-trash"></i>
                        </button>
                    `;
                };
                reader.readAsDataURL(file);
            }
        }

        function removeImagePreview() {
            document.getElementById('imagePreview').innerHTML = '';
            imageUpload.value = '';
        }

        function removeThumbnailPreview() {
            document.getElementById('thumbnailPreview').innerHTML = '';
            thumbnailUpload.value = '';
        }

        // Add Chapter
        document.querySelector('#video-form button').addEventListener('click', function() {
            const chaptersContainer = document.getElementById('chaptersContainer');
            const newChapter = document.createElement('div');
            newChapter.className = 'video-chapter flex items-center space-x-4 p-4 border border-gray-200 rounded-lg';
            newChapter.innerHTML = `
                <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Waktu Mulai</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-primary" placeholder="00:00">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs text-gray-500 mb-1">Judul Chapter</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Judul chapter">
                    </div>
                </div>
                <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            chaptersContainer.appendChild(newChapter);
        });

        // Form Submission
        document.getElementById('articleForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Artikel berhasil dipublikasikan!');
            // Add your form submission logic here
        });

        document.getElementById('videoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Video berhasil dipublikasikan!');
            // Add your form submission logic here
        });
    </script>
</body>
</html>