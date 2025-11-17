<!-- components/carousel.blade.php -->
<section id="articles" class="py-12 bg-white relative overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-dark mb-3">Inspirasi Sehat Hari Ini</h2>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto mt-4">
                Tips praktis untuk hidup sehat yang mudah diterapkan</p>
        </div>

        <div class="relative max-w-4xl mx-auto">
            <!-- Carousel Container -->
            <div id="carousel" class="overflow-hidden rounded-xl shadow-lg relative">
                <div class="flex transition-transform duration-700 ease-in-out" id="carousel-track">
                    @foreach ($articles as $article)
                        <div class="w-full flex-shrink-0">
                            <div class="bg-white rounded-xl overflow-hidden">
                                <div class="flex flex-col md:flex-row">
                                    <div class="md:w-2/5">
                                        <div class="h-40 md:h-48 w-full overflow-hidden rounded-l-xl">
                                            <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : '/img/dummy.jpg' }}"
                                                alt="{{ $article->title }}"
                                                class="w-full h-full object-cover object-center transition-transform duration-500 hover:scale-105">
                                        </div>
                                    </div>
                                    <div class="md:w-3/5 p-6">
                                        <div class="flex items-center mb-2">
                                            <span
                                                class="px-3 py-1 bg-primary bg-opacity-10 text-primary text-sm rounded-full font-medium">
                                                {{ $article->category ?? 'Artikel' }}
                                            </span>
                                        </div>
                                        <h3 class="text-xl font-bold text-dark mb-3">{{ $article->title }}</h3>
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                            {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 100) }}
                                        </p>
                                        <a href="{{ url('/articles/' . ($article->slug ?? $article->id)) }}"
                                            class="inline-flex items-center text-primary font-semibold text-sm hover:text-secondary transition">
                                            Baca Selengkapnya
                                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons -->
                <button id="carousel-prev"
                    class="absolute left-3 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-primary hover:text-white rounded-full p-3 shadow-lg transition-all duration-300">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="carousel-next"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-primary hover:text-white rounded-full p-3 shadow-lg transition-all duration-300">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Dots Indicator -->
            <div class="flex justify-center space-x-2 mt-6">
                @foreach ($articles as $index => $article)
                    <button class="carousel-dot w-2 h-2 rounded-full bg-primary opacity-30 transition-all duration-300"
                        data-slide="{{ $index }}"></button>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .carousel-dot.active {
        opacity: 1;
        width: 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
</style>

<script>
    class Carousel {
        constructor() {
            this.carousel = document.getElementById('carousel-track');
            this.slides = document.querySelectorAll('#carousel-track > div');
            this.dots = document.querySelectorAll('.carousel-dot');
            this.currentSlide = 0;
            this.slideCount = this.slides.length;
            this.autoSlideInterval = null;

            this.prevButton = document.getElementById('carousel-prev');
            this.nextButton = document.getElementById('carousel-next');

            this.init();
        }

        init() {
            // Tombol navigasi
            this.prevButton.addEventListener('click', () => this.prev());
            this.nextButton.addEventListener('click', () => this.next());

            // Dot navigasi
            this.dots.forEach((dot, index) => {
                dot.addEventListener('click', () => this.goToSlide(index));
            });

            // Mulai otomatis
            this.startAutoSlide();
            this.updateCarousel();

            // Pause saat hover
            this.carousel.parentElement.addEventListener('mouseenter', () => this.stopAutoSlide());
            this.carousel.parentElement.addEventListener('mouseleave', () => this.startAutoSlide());
        }

        goToSlide(slideIndex) {
            this.currentSlide = slideIndex;
            this.updateCarousel();
        }

        next() {
            this.currentSlide = (this.currentSlide + 1) % this.slideCount;
            this.updateCarousel();
        }

        prev() {
            this.currentSlide = (this.currentSlide - 1 + this.slideCount) % this.slideCount;
            this.updateCarousel();
        }

        updateCarousel() {
            const translateX = -this.currentSlide * 100;
            this.carousel.style.transform = `translateX(${translateX}%)`;

            this.dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === this.currentSlide);
                dot.classList.toggle('opacity-30', index !== this.currentSlide);
            });
        }

        startAutoSlide() {
            this.autoSlideInterval = setInterval(() => this.next(), 5000);
        }

        stopAutoSlide() {
            clearInterval(this.autoSlideInterval);
            this.autoSlideInterval = null;
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        new Carousel();
    });
</script>
