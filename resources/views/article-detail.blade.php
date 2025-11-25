<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - OBESIFIT</title>
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
        .article-content h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1F2937;
            margin: 2rem 0 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #E5E7EB;
        }

        .article-content p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
            color: #4B5563;
            font-size: 1.05rem;
        }

        .article-content ul,
        .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .article-content li {
            margin-bottom: 0.5rem;
            line-height: 1.7;
        }

        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: #E5E7EB;
            z-index: 1000;
        }

        .reading-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #4EAC92, #3A8C74);
            width: 0%;
            transition: width 0.3s ease;
        }

        .sidebar-card {
            transition: all 0.3s ease;
            position: sticky;
            top: 6rem;
        }

        .sidebar-card:hover {
            transform: translateY(-4px);
            box-shadow: 0px 8px 20px rgba(78, 172, 146, 0.15);
        }

        .table-of-contents a {
            display: block;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            color: #4B5563;
            text-decoration: none;
        }

        .table-of-contents a:hover,
        .table-of-contents a.active {
            background-color: #F0F9F6;
            color: #4EAC92;
            font-weight: 500;
        }

        .author-card {
            background: linear-gradient(135deg, #F0F9F6 0%, #E6F4F1 100%);
            border-radius: 1rem;
        }

        .content-section {
            scroll-margin-top: 2rem;
        }

        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: #4EAC92;
            color: white;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(78, 172, 146, 0.3);
            cursor: pointer;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .back-to-top.visible {
            opacity: 1;
        }

        .excerpt-box {
            background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);
            border-left: 4px solid #4EAC92;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin: 2rem 0;
        }

        /* Fix untuk teks panjang */
        .excerpt-content {
            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;
            hyphens: auto;
        }

        .excerpt-text {
            max-width: 100%;
            display: inline-block;
        }

        @media (max-width: 1024px) {
            .sidebar-card {
                position: relative;
                top: 0;
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

    <!-- ✅ Reading Progress Bar -->
    <div class="reading-progress">
        <div class="reading-progress-bar" id="reading-progress"></div>
    </div>

    <!-- ✅ Header Section -->
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

                @if ($article->category)
                    <div
                        class="inline-block px-3 py-1 bg-primary/10 text-primary font-semibold rounded-full mb-4 text-sm uppercase tracking-wide">
                        {{ $article->category }}
                    </div>
                @endif

                <!-- Judul artikel dengan break yang lebih baik -->
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-dark mb-6 leading-tight break-words">
                    {{ $article->title }}
                </h1>

                <!-- Excerpt dengan fix untuk teks panjang -->
                @if ($article->excerpt)
                    <div class="excerpt-box">
                        <div class="flex items-start">
                            <i class="fas fa-quote-left text-primary mt-1 mr-3 text-lg flex-shrink-0"></i>
                            <div class="excerpt-content flex-1 min-w-0">
                                <h3 class="font-semibold text-dark mb-2 text-lg">Ringkasan Artikel</h3>
                                <p class="text-gray-700 leading-relaxed excerpt-text">
                                    {{ $article->excerpt }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-10 p-6 author-card">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 rounded-full overflow-hidden shadow-md border-2 border-white">
                            @if ($article->user->profile_photo)
                                <img src="{{ asset('storage/' . $article->user->profile_photo) }}" alt="Profile Photo"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-primary flex items-center justify-center">
                                    <i class="fas fa-user text-white text-xl"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="font-semibold text-dark text-lg">
                                {{ $article->user->first_name }} {{ $article->user->last_name }}
                            </div>
                            <div class="text-gray-600">
                                {{ $article->user->specialization ?? 'Praktisi Kesehatan' }}
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4 text-gray-500">
                        <div class="flex items-center">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>{{ $article->created_at->timezone('Asia/Jakarta')->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="far fa-clock mr-2"></i>
                            <span>{{ $article->read_time }} menit baca</span>
                        </div>
                    </div>
                </div>

                @if ($article->featured_image)
                    <div class="rounded-2xl overflow-hidden shadow-lg mb-2">
                        <img src="{{ asset('storage/' . $article->featured_image) }}"
                            class="w-full h-64 md:h-96 object-cover" alt="Gambar utama artikel: {{ $article->title }}">
                    </div>
                @else
                    <div class="rounded-2xl overflow-hidden shadow-lg mb-2">
                        <img src="{{ asset('/img/dummy.jpg') }}" class="w-full h-64 md:h-96 object-cover"
                            alt="Gambar placeholder untuk artikel: {{ $article->title }}">
                    </div>
                @endif

                <!-- Image caption jika diperlukan -->
                <p class="text-center text-gray-500 text-sm mt-2">Ilustrasi artikel kesehatan</p>

            </div>
        </div>
    </section>

    <!-- ✅ Content Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto flex flex-col lg:flex-row gap-10">

                <!-- ✅ Main Content -->
                <div class="lg:w-2/3">
                    <div class="article-content bg-white p-6 rounded-xl shadow-sm">
                        @foreach ($article->subContents as $index => $sub)
                            <div id="section-{{ $index }}" class="content-section">
                                <h2>{{ $sub->title }}</h2>
                                <div class="prose max-w-none">
                                    {!! nl2br(e($sub->content)) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- ✅ Sidebar -->
                <div class="lg:w-1/3">
                    <div class="bg-white p-6 rounded-xl shadow-md sidebar-card">
                        <h3 class="font-bold text-dark mb-4 text-lg flex items-center">
                            <i class="fas fa-list-ul mr-2 text-primary"></i>
                            Daftar Isi
                        </h3>
                        <nav class="table-of-contents">
                            @foreach ($article->subContents as $index => $sub)
                                <a href="#section-{{ $index }}" data-section="section-{{ $index }}"
                                    class="toc-link">
                                    {{ $sub->title }}
                                </a>
                            @endforeach
                        </nav>
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
    <div id="back-to-top" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </div>

    <!-- ✅ Reading Progress & Interactive Scripts -->
    <script>
        // Reading Progress
        const progress = document.getElementById("reading-progress");
        window.addEventListener("scroll", function() {
            let scrollTop = window.scrollY;
            let docHeight = document.body.scrollHeight - window.innerHeight;
            let scrollPercent = (scrollTop / docHeight) * 100;
            progress.style.width = scrollPercent + "%";

            // Show/hide back to top button
            const backToTop = document.getElementById('back-to-top');
            if (scrollTop > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }

            // Update active TOC link
            updateActiveTOC();
        });

        // Back to top functionality
        document.getElementById('back-to-top').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scrolling for TOC links
        document.querySelectorAll('.toc-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Update active TOC link based on scroll position
        function updateActiveTOC() {
            const sections = document.querySelectorAll('.content-section');
            const navLinks = document.querySelectorAll('.toc-link');

            let currentSection = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 150;
                if (window.scrollY >= sectionTop) {
                    currentSection = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-section') === currentSection) {
                    link.classList.add('active');
                }
            });
        }
    </script>

</body>

</html>
