<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel & Video - OBESIFIT</title>
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

        /* Card Hover Effects */
        .content-card {
            transition: all 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(78, 172, 146, 0.15);
        }

        /* Tab Styles */
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

        /* Text Clamp */
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Video Play Button Animation */
        .play-button {
            transition: all 0.3s ease;
        }

        .content-card:hover .play-button {
            transform: scale(1.1);
        }

        /* Category Badge */
        .category-badge {
            transition: all 0.3s ease;
        }

        .content-card:hover .category-badge {
            transform: translateY(-2px);
        }

        /* Search Input Animation */
        .search-wrapper input:focus {
            box-shadow: 0 0 0 3px rgba(78, 172, 146, 0.1);
        }

        /* Empty State Animation */
        .empty-state {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Loading Animation */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        /* Content Section Transition */
        .content-section {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .content-card:hover {
                transform: translateY(-4px);
            }

            .tab-button {
                font-size: 0.875rem;
                padding: 0.5rem 1rem;
            }
        }

        /* Image Loading Effect */
        .content-card img {
            transition: transform 0.3s ease;
        }

        .content-card:hover img {
            transform: scale(1.05);
        }

        .image-wrapper {
            overflow: hidden;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }

            100% {
                transform: scale(1.2);
                opacity: 0;
            }
        }

        .fixed.bottom-8::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(135deg, #4EAC92, #3A8C74);
            animation: pulse-ring 2s infinite;
        }
    </style>
</head>

<body class="font-poppins bg-light">
    <!-- Include Navbar Component -->
    @auth
        @include('components.navbar-user')
    @endauth

    <!-- Hero Section - Enhanced -->
    <section
        class="bg-gradient-to-br from-primary via-secondary to-accent text-white pt-24 pb-12 md:pt-28 md:pb-16 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>

        <div class="container mx-auto px-4 text-center relative">
            <div class="inline-block mb-4">
                <div
                    class="w-16 h-16 md:w-20 md:h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto backdrop-blur-sm">
                    <i class="fas fa-book-open text-3xl md:text-4xl"></i>
                </div>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight">Edukasi Kesehatan</h1>
            <p class="text-base md:text-xl text-green-100 max-w-2xl mx-auto leading-relaxed">
                Temukan artikel informatif dan video edukasi<br class="hidden md:block">
                untuk mendukung perjalanan sehat Anda
            </p>
        </div>
    </section>

    <!-- Filter & Search Section - Enhanced -->
    <section class="bg-white py-6 md:py-8 border-b shadow-sm sticky top-16 z-40">
        <div class="container mx-auto px-4">
            <div class="flex flex-col gap-4">
                <!-- Tab Navigation -->
                <div class="flex justify-center">
                    <div class="inline-flex space-x-2 bg-gray-100 rounded-xl p-1.5">
                        <button class="tab-button px-4 md:px-6 py-2.5 rounded-lg font-medium active-tab" data-tab="all">
                            <i class="fas fa-th-large mr-2"></i>Semua
                        </button>
                        <button class="tab-button px-4 md:px-6 py-2.5 rounded-lg font-medium text-gray-600"
                            data-tab="articles">
                            <i class="fas fa-newspaper mr-2"></i>Artikel
                        </button>
                        <button class="tab-button px-4 md:px-6 py-2.5 rounded-lg font-medium text-gray-600"
                            data-tab="videos">
                            <i class="fas fa-video mr-2"></i>Video
                        </button>
                    </div>
                </div>

                <!-- Search & Filter -->
                <form id="filterForm" method="GET" action="{{ route('articles-videos') }}"
                    class="flex flex-col md:flex-row gap-3 items-center justify-center">

                    <div class="w-full md:w-auto md:flex-1 md:max-w-md search-wrapper relative">
                        <input type="text" name="search" id="searchInput" placeholder="Cari artikel atau video..."
                            value="{{ request('search') }}"
                            class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition">
                        <i class="fas fa-search absolute left-4 top-4 text-gray-400"></i>
                    </div>

                    <select name="category" id="categorySelect"
                        class="w-full md:w-auto px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition bg-white">
                        <option value="">Semua Kategori</option>
                        <option value="Nutrition" {{ request('category') == 'Nutrition' ? 'selected' : '' }}>Nutrition
                        </option>
                        <option value="Exercise" {{ request('category') == 'Exercise' ? 'selected' : '' }}>Exercise
                        </option>
                        <option value="Mental Health" {{ request('category') == 'Mental Health' ? 'selected' : '' }}>
                            Mental Health</option>
                        <option value="Tips Sehat" {{ request('category') == 'Tips Sehat' ? 'selected' : '' }}>Tips
                            Sehat</option>
                        <option value="Obesitas" {{ request('category') == 'Obesitas' ? 'selected' : '' }}>Obesitas
                        </option>
                    </select>

                    <select name="sort" id="sortSelect"
                        class="w-full md:w-auto px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition bg-white">
                        <option value="Terbaru" {{ request('sort') == 'Terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="Terlama" {{ request('sort') == 'Terlama' ? 'selected' : '' }}>Terlama</option>
                        <option value="Durasi Terpendek" {{ request('sort') == 'Durasi Terpendek' ? 'selected' : '' }}>
                            Durasi Terpendek</option>
                    </select>
                </form>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-8 md:py-12 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">

            <!-- All Content (Default) -->
            <div id="all-content" class="content-section">
                <!-- Articles Section -->
                <div class="mb-12">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl md:text-3xl font-bold text-dark flex items-center">
                            <i class="fas fa-newspaper text-primary mr-3"></i>
                            Artikel Terbaru
                        </h2>
                    </div>

                    @if ($articles->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($articles as $article)
                                <div
                                    class="bg-white rounded-2xl overflow-hidden shadow-sm content-card border border-gray-100">
                                    <div class="image-wrapper">
                                        <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('img/dummy.jpg') }}"
                                            alt="{{ $article->title }}" class="w-full h-48 object-cover">
                                    </div>
                                    <div class="p-5 md:p-6">
                                        <div class="flex items-center mb-3 flex-wrap gap-2">
                                            <span
                                                class="category-badge px-3 py-1 {{ $article->category == 'nutrition' ? 'bg-primary bg-opacity-10 text-primary' : ($article->category == 'exercise' ? 'bg-secondary bg-opacity-10 text-secondary' : 'bg-accent bg-opacity-10 text-accent') }} text-xs md:text-sm rounded-full font-medium">
                                                {{ ucfirst($article->category) }}
                                            </span>
                                            <span class="text-gray-500 text-xs md:text-sm flex items-center">
                                                <i class="far fa-clock mr-1"></i> {{ $article->read_time ?? 5 }} min
                                            </span>
                                        </div>
                                        <h3 class="text-lg md:text-xl font-bold text-dark mb-3 line-clamp-2">
                                            {{ $article->title }}</h3>
                                        <p class="text-gray-600 text-sm md:text-base mb-4 line-clamp-3">
                                            {{ $article->excerpt }}</p>
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-primary rounded-full flex items-center justify-center mr-2">
                                                    <i class="fas fa-user text-white text-xs"></i>
                                                </div>
                                                <span
                                                    class="text-xs md:text-sm text-gray-600 truncate max-w-[120px]">{{ $article->author->full_name ?? 'Admin' }}</span>
                                            </div>
                                            <a href="{{ route('articles.show', $article->id) }}"
                                                class="text-primary hover:text-secondary font-semibold text-sm transition flex items-center">
                                                Baca <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination Articles -->
                        <div class="mt-8">
                            <div class="pagination">
                                {{ $articles->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-16 empty-state">
                            <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg">Tidak ada artikel ditemukan</p>
                        </div>
                    @endif
                </div>

                <!-- Videos Section -->
                <div class="mt-12">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl md:text-3xl font-bold text-dark flex items-center">
                            <i class="fas fa-video text-primary mr-3"></i>
                            Video Edukasi
                        </h2>
                    </div>

                    @if ($videos->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($videos as $video)
                                <div
                                    class="bg-white rounded-2xl overflow-hidden shadow-sm content-card border border-gray-100">
                                    <a href="{{ route('videos.show', $video->id) }}">
                                        <div class="relative image-wrapper">
                                            <img src="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : asset('img/dummy.jpg') }}"
                                                alt="{{ $video->title }}" class="w-full h-48 object-cover">
                                            <div
                                                class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                                <div
                                                    class="w-16 h-16 bg-primary rounded-full flex items-center justify-center cursor-pointer play-button shadow-lg">
                                                    <i class="fas fa-play text-white text-xl ml-1"></i>
                                                </div>
                                            </div>
                                            <div
                                                class="absolute top-3 right-3 bg-black bg-opacity-70 text-white px-2 py-1 rounded-lg text-xs font-medium">
                                                <i class="far fa-clock mr-1"></i>{{ $video->duration }}:00
                                            </div>
                                        </div>
                                    </a>
                                    <div class="p-5 md:p-6">
                                        <div class="flex items-center mb-3">
                                            <span
                                                class="category-badge px-3 py-1 bg-primary bg-opacity-10 text-primary text-xs md:text-sm rounded-full font-medium">
                                                {{ $video->category }}
                                            </span>
                                        </div>
                                        <h3 class="text-lg md:text-xl font-bold text-dark mb-3 line-clamp-2">
                                            {{ $video->title }}</h3>
                                        <p class="text-gray-600 text-sm md:text-base mb-4 line-clamp-2">
                                            {{ $video->excerpt }}</p>
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-primary rounded-full flex items-center justify-center mr-2">
                                                    <i class="fas fa-user text-white text-xs"></i>
                                                </div>
                                                <span
                                                    class="text-xs md:text-sm text-gray-600 truncate max-w-[120px]">{{ $video->creator->full_name }}</span>
                                            </div>
                                            <a href="{{ route('videos.show', $video->id) }}"
                                                class="text-primary hover:text-secondary font-semibold text-sm transition flex items-center">
                                                Tonton <i class="fas fa-play ml-1 text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination Videos -->
                        <div class="mt-8">
                            <div class="pagination">
                                {{ $videos->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-16 empty-state">
                            <i class="fas fa-video text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg">Tidak ada video ditemukan</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Articles Only Content -->
            <div id="articles-content" class="content-section hidden">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl md:text-3xl font-bold text-dark flex items-center">
                        <i class="fas fa-newspaper text-primary mr-3"></i>
                        Artikel
                    </h2>
                </div>

                @if ($articles->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($articles as $article)
                            <div
                                class="bg-white rounded-2xl overflow-hidden shadow-sm content-card border border-gray-100">
                                <div class="image-wrapper">
                                    <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('img/dummy.jpg') }}"
                                        alt="{{ $article->title }}" class="w-full h-48 object-cover">
                                </div>
                                <div class="p-5 md:p-6">
                                    <div class="flex items-center mb-3 flex-wrap gap-2">
                                        <span
                                            class="category-badge px-3 py-1 {{ $article->category == 'nutrition' ? 'bg-primary bg-opacity-10 text-primary' : ($article->category == 'exercise' ? 'bg-secondary bg-opacity-10 text-secondary' : 'bg-accent bg-opacity-10 text-accent') }} text-xs md:text-sm rounded-full font-medium">
                                            {{ ucfirst($article->category) }}
                                        </span>
                                        <span class="text-gray-500 text-xs md:text-sm flex items-center">
                                            <i class="far fa-clock mr-1"></i> {{ $article->read_time ?? 5 }} min
                                        </span>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-dark mb-3 line-clamp-2">
                                        {{ $article->title }}</h3>
                                    <p class="text-gray-600 text-sm md:text-base mb-4 line-clamp-3">
                                        {{ $article->excerpt }}</p>
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 bg-primary rounded-full flex items-center justify-center mr-2">
                                                <i class="fas fa-user text-white text-xs"></i>
                                            </div>
                                            <span
                                                class="text-xs md:text-sm text-gray-600 truncate max-w-[120px]">{{ $article->author->full_name ?? 'Admin' }}</span>
                                        </div>
                                        <a href="{{ route('articles.show', $article->id) }}"
                                            class="text-primary hover:text-secondary font-semibold text-sm transition flex items-center">
                                            Baca <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        <div class="pagination">
                            {{ $articles->links() }}
                        </div>
                    </div>
                @else
                    <div class="text-center py-16 empty-state">
                        <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">Tidak ada artikel ditemukan</p>
                    </div>
                @endif
            </div>

            <!-- Videos Only Content -->
            <div id="videos-content" class="content-section hidden">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl md:text-3xl font-bold text-dark flex items-center">
                        <i class="fas fa-video text-primary mr-3"></i>
                        Video Edukasi
                    </h2>
                </div>

                @if ($videos->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($videos as $video)
                            <div
                                class="bg-white rounded-2xl overflow-hidden shadow-sm content-card border border-gray-100">
                                <a href="{{ route('videos.show', $video->id) }}">
                                    <div class="relative image-wrapper">
                                        <img src="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : asset('img/dummy.jpg') }}"
                                            alt="{{ $video->title }}" class="w-full h-48 object-cover">
                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                            <div
                                                class="w-16 h-16 bg-primary rounded-full flex items-center justify-center cursor-pointer play-button shadow-lg">
                                                <i class="fas fa-play text-white text-xl ml-1"></i>
                                            </div>
                                        </div>
                                        <div
                                            class="absolute top-3 right-3 bg-black bg-opacity-70 text-white px-2 py-1 rounded-lg text-xs font-medium">
                                            <i class="far fa-clock mr-1"></i>{{ $video->duration }}:00
                                        </div>
                                    </div>
                                </a>
                                <div class="p-5 md:p-6">
                                    <div class="flex items-center mb-3">
                                        <span
                                            class="category-badge px-3 py-1 bg-primary bg-opacity-10 text-primary text-xs md:text-sm rounded-full font-medium">
                                            {{ $video->category }}
                                        </span>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-dark mb-3 line-clamp-2">
                                        {{ $video->title }}</h3>
                                    <p class="text-gray-600 text-sm md:text-base mb-4 line-clamp-2">
                                        {{ $video->excerpt }}</p>
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 bg-primary rounded-full flex items-center justify-center mr-2">
                                                <i class="fas fa-user text-white text-xs"></i>
                                            </div>
                                            <span
                                                class="text-xs md:text-sm text-gray-600 truncate max-w-[120px]">{{ $video->creator->full_name }}</span>
                                        </div>
                                        <a href="{{ route('videos.show', $video->id) }}"
                                            class="text-primary hover:text-secondary font-semibold text-sm transition flex items-center">
                                            Tonton <i class="fas fa-play ml-1 text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        <div class="pagination">
                            {{ $videos->links() }}
                        </div>
                    </div>
                @else
                    <div class="text-center py-16 empty-state">
                        <i class="fas fa-video text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">Tidak ada video ditemukan</p>
                    </div>
                @endif
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-8">
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

    @auth
        @if (auth()->user()->role === 'doctor')
            <!-- Floating Action Button -->
            <a href="{{ route('articles-videos.create') }}"
                class="fixed bottom-8 right-8 w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-primary via-secondary to-accent text-white rounded-full shadow-2xl hover:shadow-primary/50 flex items-center justify-center transition-all duration-300 hover:scale-110 z-50 group">
                <i class="fas fa-plus text-xl md:text-2xl group-hover:rotate-90 transition-transform duration-300"></i>
                <span
                    class="absolute right-full mr-3 bg-dark text-white px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    Buat Konten Baru
                </span>
            </a>
        @endif
    @endauth

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab Navigation
            const tabButtons = document.querySelectorAll('.tab-button');
            const allContent = document.getElementById('all-content');
            const articlesContent = document.getElementById('articles-content');
            const videosContent = document.getElementById('videos-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tab = this.getAttribute('data-tab');

                    // Update active tab styling
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active-tab');
                        btn.classList.add('text-gray-600');
                    });
                    this.classList.add('active-tab');
                    this.classList.remove('text-gray-600');

                    // Show/hide content based on selected tab
                    if (tab === 'all') {
                        allContent.classList.remove('hidden');
                        articlesContent.classList.add('hidden');
                        videosContent.classList.add('hidden');
                    } else if (tab === 'articles') {
                        allContent.classList.add('hidden');
                        articlesContent.classList.remove('hidden');
                        videosContent.classList.add('hidden');
                    } else if (tab === 'videos') {
                        allContent.classList.add('hidden');
                        articlesContent.classList.add('hidden');
                        videosContent.classList.remove('hidden');
                    }
                });
            });

            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    const menu = document.getElementById('mobile-menu');
                    if (menu) menu.classList.toggle('hidden');
                });
            }

            // Smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                        const mobileMenu = document.getElementById('mobile-menu');
                        if (mobileMenu) mobileMenu.classList.add('hidden');
                    }
                });
            });

            // Filter & Search
            const filterForm = document.getElementById('filterForm');
            const searchInput = document.getElementById('searchInput');
            const categorySelect = document.getElementById('categorySelect');
            const sortSelect = document.getElementById('sortSelect');

            if (categorySelect) {
                categorySelect.addEventListener('change', () => filterForm.submit());
            }

            if (sortSelect) {
                sortSelect.addEventListener('change', () => filterForm.submit());
            }

            // Submit otomatis saat mengetik search (dengan delay)
            if (searchInput) {
                let typingTimer;
                const typingDelay = 500; // 0.5 detik setelah user berhenti mengetik

                searchInput.addEventListener('keyup', () => {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(() => filterForm.submit(), typingDelay);
                });

                searchInput.addEventListener('keydown', () => {
                    clearTimeout(typingTimer);
                });
            }
        });
    </script>

</body>

</html>
