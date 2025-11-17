<!-- components/video-edukasi.blade.php -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Edukasi Video</h2>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto mt-4">
                Belajar kesehatan melalui video yang menarik dan mudah dipahami
            </p>
        </div>

        <!-- Filter Categories -->
        <div class="flex flex-wrap justify-center gap-3 mb-8">
            <button data-category="Semua"
                class="category-filter px-4 py-2 bg-primary text-white rounded-full text-sm font-medium hover:bg-secondary transition">
                Semua
            </button>
            @foreach ($categories as $category)
                <button data-category="{{ $category }}"
                    class="category-filter px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition">
                    {{ $category }}
                </button>
            @endforeach
        </div>

        <!-- Video Grid -->
        <div id="video-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach ($videos as $video)
                <a href="{{ url('/videos/' . $video->id) }}"
                    class="bg-gray-50 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300 group video-card block">
                    <div class="relative">
                        <img src="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : asset('img/dummy.jpg') }}"
                            alt="{{ $video->title }}"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center">
                                <i class="fas fa-play text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center mb-2">
                            <span
                                class="px-2 py-1 bg-primary bg-opacity-10 text-primary text-xs rounded-full font-medium">
                                {{ $video->category }}
                            </span>
                            <span class="text-gray-500 text-xs ml-2 flex items-center">
                                <i class="fas fa-clock mr-1"></i> {{ $video->duration ?? '0:00' }} menit
                            </span>
                        </div>
                        <h3 class="font-bold text-dark mb-2 line-clamp-2">{{ $video->title }}</h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $video->excerpt }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-6 h-6 bg-primary rounded-full flex items-center justify-center mr-2">
                                    <i class="fas fa-user text-white text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-600">{{ $video->creator->full_name ?? 'Admin' }}</span>
                            </div>
                            <span class="text-primary hover:text-secondary transition flex items-center text-sm">
                                <i class="fas fa-play-circle mr-1"></i> Lihat
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.category-filter');
        const videoGrid = document.getElementById('video-grid');

        buttons.forEach(btn => {
            btn.addEventListener('click', function() {
                const category = this.dataset.category;

                // Tombol aktif
                buttons.forEach(b => b.classList.remove('bg-primary', 'text-white'));
                this.classList.add('bg-primary', 'text-white');

                fetch(`{{ route('videos.filter') }}?category=${encodeURIComponent(category)}`)
                    .then(res => res.json())
                    .then(videos => {
                        videoGrid.innerHTML = '';

                        if (videos.length === 0) {
                            videoGrid.innerHTML =
                                `<div class='col-span-3 text-center text-gray-500'>Tidak ada video ${category}</div>`;
                            return;
                        }

                        videos.forEach(video => {
                            videoGrid.innerHTML += `
                            <div class="bg-gray-50 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300 group video-card">
                                <div class="relative">
                                    <img src="${video.thumbnail_url || '/img/default-video.jpg'}" alt="${video.title}"
                                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center">
                                            <i class="fas fa-play text-white text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="absolute top-3 right-3 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-sm">
                                        ${video.duration || '0:00'}
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex items-center mb-2">
                                        <span class="px-2 py-1 bg-primary bg-opacity-10 text-primary text-xs rounded-full font-medium">
                                            ${video.category}
                                        </span>
                                        <span class="text-gray-500 text-xs ml-2 flex items-center">
                                            <i class="fas fa-eye mr-1"></i> ${video.views || 0}
                                        </span>
                                    </div>
                                    <h3 class="font-bold text-dark mb-2 line-clamp-2">${video.title}</h3>
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">${video.excerpt || ''}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 bg-primary rounded-full flex items-center justify-center mr-2">
                                                <i class="fas fa-user text-white text-xs"></i>
                                            </div>
                                            <span class="text-xs text-gray-600">${video.creator?.name || 'Admin'}</span>
                                        </div>
                                        <a href="${video.video_url}" target="_blank"
                                            class="text-primary hover:text-secondary transition flex items-center text-sm">
                                            <i class="fas fa-play-circle mr-1"></i> Tonton
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `;
                        });
                    });
            });
        });
    });
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .video-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .video-card:hover {
        transform: translateY(-4px);
    }

    .category-filter.active {
        background-color: #4EAC92 !important;
        color: white !important;
    }
</style>
