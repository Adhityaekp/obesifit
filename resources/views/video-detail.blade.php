<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $video->title }} - OBESIFIT</title>
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
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            background: #000;
        }

        .video-container iframe,
        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .creator-card {
            background: linear-gradient(135deg, #F0F9F6 0%, #E6F4F1 100%);
            border-radius: 1rem;
        }

        .category-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: rgba(78, 172, 146, 0.1);
            color: #4EAC92;
            border-radius: 1rem;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .action-button {
            transition: all 0.3s ease;
        }

        .action-button:hover {
            transform: translateY(-2px);
        }

        .video-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .video-info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body class="font-poppins bg-gradient-to-b from-gray-50 to-white">
    <!-- ✅ Navbar -->
    @auth
        @if (Auth::user()->role === 'admin')
            @include('components.admin-navbar')
        @else
            @include('components.navbar-user')
        @endif
    @endauth

    <!-- Video Header Section -->
    <section class="bg-white pt-10 pb-10 shadow-sm">
        <div class="container mx-auto px-4">
            <!-- Tombol Back -->
            <div class="max-w-4xl mx-auto mb-6">
                <button onclick="window.history.back()"
                    class="flex items-center text-gray-600 hover:text-primary transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </button>
            </div>

            <div class="max-w-4xl mx-auto">
                <!-- Category Badge -->
                @if ($video->category)
                    <div class="category-badge mb-4">
                        {{ ucfirst($video->category) }}
                    </div>
                @endif

                <!-- Video Title -->
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-dark mb-6 leading-tight break-words">
                    {{ $video->title }}
                </h1>

                <!-- Creator Information -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-8 p-6 creator-card">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 rounded-full overflow-hidden shadow-md border-2 border-white">
                            @if ($video->creator->profile_photo)
                                <img src="{{ asset('storage/' . $video->creator->profile_photo) }}"
                                    alt="Profile Photo {{ $video->creator->full_name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-primary flex items-center justify-center">
                                    <i class="fas fa-user text-white text-xl"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="font-semibold text-dark text-lg">
                                {{ $video->creator->full_name }}
                            </div>
                            <div class="text-gray-600">
                                Konten Kreator
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4 text-gray-500">
                        <div class="flex items-center">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>{{ $video->created_at->timezone('Asia/Jakarta')->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="far fa-clock mr-2"></i>
                            <span>{{ $video->duration ?? 'Video' }} menit</span>
                        </div>
                    </div>
                </div>

                <!-- Video Excerpt -->
                @if ($video->excerpt)
                    <div
                        class="bg-gradient-to-r from-primary/5 to-secondary/5 border-l-4 border-primary p-6 rounded-r-lg mb-8">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-primary mt-1 mr-3 text-lg"></i>
                            <div class="flex-1">
                                <h3 class="font-semibold text-dark mb-2 text-lg">Tentang Video Ini</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $video->excerpt }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Video Player -->
                <div class="mb-8">
                    <div class="video-container">
                        @if (Str::startsWith($video->video_url, 'https://www.youtube.com') ||
                                Str::startsWith($video->video_url, 'https://youtu.be'))
                            <!-- YouTube Embed -->
                            <iframe src="{{ $video->video_url }}" title="{{ $video->title }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        @else
                            <!-- Local MP4 -->
                            <video controls class="w-full h-full">
                                <source src="{{ asset('storage/videos/' . $video->video_url) }}" type="video/mp4">
                                Browser anda tidak mendukung video tag.
                            </video>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @auth
        @if (Auth::user()->role === 'admin')
            <!-- Admin Footer -->
            <footer class="bg-dark text-white py-8 mt-12">
                <div class="container mx-auto px-4">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-4 md:mb-0">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-heartbeat text-white"></i>
                                </div>
                                <span class="text-xl font-bold">OBESIFIT <span
                                        class="text-sm bg-primary text-white px-2 py-1 rounded ml-2">Admin</span></span>
                            </div>
                            <p class="text-gray-400 mt-2">Platform Edukasi Obesitas Interaktif</p>
                        </div>
                        <div class="text-center md:text-right">
                            <p class="text-gray-400">&copy; 2025 OBESIFIT. All rights reserved.</p>
                            <p class="text-gray-400 text-sm mt-1">Admin Panel v2.1.0</p>
                        </div>
                    </div>
                </div>
            </footer>
        @else
            <!-- User/Doctor Footer -->
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
        @endif
    @else
        <!-- Guest Footer (sama seperti user) -->
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
    @endauth

    <!-- Back to Top Button -->
    <div id="back-to-top"
        class="fixed bottom-8 right-8 bg-primary text-white w-12 h-12 rounded-full flex items-center justify-center cursor-pointer opacity-0 transition-opacity duration-300 shadow-lg hover:bg-secondary">
        <i class="fas fa-arrow-up"></i>
    </div>

    <script>
        // Back to Top Functionality
        const backToTop = document.getElementById('back-to-top');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTop.classList.remove('opacity-0');
                backToTop.classList.add('opacity-100');
            } else {
                backToTop.classList.remove('opacity-100');
                backToTop.classList.add('opacity-0');
            }
        });

        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Simple like functionality
        document.querySelectorAll('.action-button').forEach(button => {
            button.addEventListener('click', function() {
                if (this.querySelector('.fa-thumbs-up')) {
                    const icon = this.querySelector('i');
                    if (icon.classList.contains('far')) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        this.style.backgroundColor = '#3A8C74';
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        this.style.backgroundColor = '#4EAC92';
                    }
                }
            });
        });
    </script>

</body>

</html>
