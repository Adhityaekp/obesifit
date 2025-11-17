<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBESIFIT - Platform Edukasi Obesitas</title>
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
        .hero-bg {
            background: linear-gradient(90deg, #F9FAFB 60%, rgba(78, 172, 146, 0.1) 100%);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        .testimonial-card {
            background: linear-gradient(135deg, #4EAC92 0%, #3A8C74 100%);
        }
    </style>
</head>

<body class="font-poppins bg-light">
    <!-- Header/Navbar -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-heartbeat text-white text-xl"></i>
                </div>
                <span class="text-xl font-bold text-dark">OBESIFIT</span>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden text-dark">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-8">
                <a href="#beranda" class="text-dark hover:text-primary font-medium">Beranda</a>
                <a href="#tentang" class="text-dark hover:text-primary font-medium">Tentang</a>
                <a href="#fitur" class="text-dark hover:text-primary font-medium">Fitur</a>
                <a href="#testimoni" class="text-dark hover:text-primary font-medium">Testimoni</a>
                <a href="#kontak" class="text-dark hover:text-primary font-medium">Kontak</a>
            </nav>

            <div class="hidden md:flex space-x-4">
                <a href="/login" class="px-4 py-2 text-primary font-medium hover:bg-green-50 rounded-lg">Masuk</a>
                <a href="/login"
                    class="px-4 py-2 bg-primary text-white font-medium rounded-lg hover:bg-secondary transition">Daftar</a>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white py-4 px-4 shadow-lg">
            <div class="flex flex-col space-y-4">
                <a href="#beranda" class="text-dark hover:text-primary font-medium">Beranda</a>
                <a href="#tentang" class="text-dark hover:text-primary font-medium">Tentang</a>
                <a href="#fitur" class="text-dark hover:text-primary font-medium">Fitur</a>
                <a href="#testimoni" class="text-dark hover:text-primary font-medium">Testimoni</a>
                <a href="#kontak" class="text-dark hover:text-primary font-medium">Kontak</a>
                <div class="pt-4 border-t border-gray-200 flex flex-col space-y-3">
                    <a href="#"
                        class="px-4 py-2 text-primary font-medium text-center border border-primary rounded-lg">Masuk</a>
                    <a href="#"
                        class="px-4 py-2 bg-primary text-white font-medium text-center rounded-lg">Daftar</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="beranda" class="hero-bg py-12 md:py-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8 text-left">
                    <h1 class="text-4xl md:text-5xl font-bold text-dark mb-6">Selamat Datang di <span
                            class="text-primary">OBESIFIT</span></h1>
                    <p class="text-lg text-gray-700 mb-8">Platform edukasi obesitas interaktif untuk meningkatkan
                        pengetahuan dan mendorong gaya hidup sehat melalui pendekatan yang personal, visual, dan mudah
                        diakses.</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#"
                            class="px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-secondary transition text-center">Mulai
                            Sekarang</a>
                        <a href="#tentang"
                            class="px-6 py-3 bg-white text-primary font-bold border border-primary rounded-lg hover:bg-green-50 transition text-center">Pelajari
                            Lebih Lanjut</a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src="/img/MainbG1 1.png" alt="Ilustrasi OBESIFIT" class="rounded-lg max-w-md w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Tentang OBESIFIT</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
            </div>

            <div class="max-w-3xl mx-auto text-center">
                <p class="text-lg text-gray-700">
                    OBESIFIT adalah platform berbasis website yang dirancang untuk memberikan edukasi seputar obesitas
                    secara interaktif dan mudah dipahami.
                    Platform ini memfasilitasi pengguna untuk belajar mengenai penyebab, dampak, dan pencegahan obesitas
                    melalui berbagai fitur.
                </p>
            </div>

            <div class="flex justify-center">
                <img src="/img/tentang_kami.png" alt="Ilustrasi Tentang OBESIFIT" class="rounded-lg w-full">
            </div>
        </div>
    </section>

    <!-- Fitur Section 1: Artikel -->
    <section id="fitur" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center mb-20">
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8">
                    <img src="/img/artikel section.png" alt="Artikel Kesehatan" class="rounded-lg w-full">
                </div>
                <div class="md:w-1/2 md:pl-8">
                    <h2 class="text-3xl md:text-4xl font-bold text-dark mb-6">Artikel Kesehatan</h2>
                    <p class="text-lg text-gray-700 mb-6">
                        Akses berbagai artikel informatif tentang penyebab, dampak, dan pencegahan obesitas yang ditulis
                        oleh ahli gizi dan dokter.
                        Artikel kami disajikan dengan bahasa yang mudah dipahami dan dilengkapi dengan visual yang
                        menarik.
                    </p>
                    <p class="text-lg text-gray-700 mb-8">
                        Dapatkan informasi terbaru seputar pola makan sehat, tips olahraga, dan strategi menjaga berat
                        badan ideal melalui artikel-artikel berkualitas kami.
                    </p>
                    <a href="#"
                        class="px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-secondary transition inline-flex items-center">
                        Jelajahi Artikel <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Fitur Section 2: Video Edukasi -->
            <div class="flex flex-col md:flex-row items-center mb-20">
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8 order-2 md:order-1">
                    <h2 class="text-3xl md:text-4xl font-bold text-dark mb-6">Video Edukasi</h2>
                    <p class="text-lg text-gray-700 mb-6">
                        Belajar melalui video visual yang menarik tentang pola makan sehat, olahraga, dan tips menjaga
                        berat badan ideal.
                        Video kami dirancang khusus untuk memberikan pemahaman yang lebih mendalam tentang obesitas.
                    </p>
                    <p class="text-lg text-gray-700 mb-8">
                        Dengan video edukasi, Anda dapat melihat langsung demonstrasi olahraga, tutorial memasak sehat,
                        dan penjelasan dari ahli gizi secara visual.
                    </p>
                    <a href="#"
                        class="px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-secondary transition inline-flex items-center">
                        Tonton Video <i class="fas fa-play-circle ml-2"></i>
                    </a>
                </div>
                <div class="md:w-1/2 md:pl-8 order-1 md:order-2">
                    <img src="/img/kalkulator.png" alt="Kalkulator kalori" class="rounded-lg w-full">
                </div>
            </div>

            <!-- Fitur Section 3: Kalkulator BMI -->
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8">
                    <img src="/img/Doctor.png" alt="Kalkulator BMI" class="rounded-lg w-full">
                </div>
                <div class="md:w-1/2 md:pl-8">
                    <h2 class="text-3xl md:text-4xl font-bold text-dark mb-6">Kalkulator BMI</h2>
                    <p class="text-lg text-gray-700 mb-6">
                        Hitung Indeks Massa Tubuh (BMI) Anda dengan mudah dan dapatkan rekomendasi personal berdasarkan
                        hasil perhitungan.
                        Alat ini membantu Anda memahami status berat badan Anda secara akurat.
                    </p>
                    <p class="text-lg text-gray-700 mb-8">
                        Setelah mengetahui BMI Anda, kami akan memberikan saran dan rekomendasi khusus untuk membantu
                        Anda mencapai berat badan ideal.
                    </p>
                    <a href="#"
                        class="px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-secondary transition inline-flex items-center">
                        Hitung BMI <i class="fas fa-calculator ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Apa Kata Pengguna OBESIFIT?</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mt-4">Dengarkan pengalaman langsung dari mereka yang
                    telah merasakan manfaat OBESIFIT</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimoni 1 -->
                <div class="testimonial-card text-white rounded-lg shadow-lg p-6 feature-card">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-primary text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Ahmad Rizki</h3>
                            <p class="text-green-100">Pengguna 3 bulan</p>
                        </div>
                    </div>
                    <p class="mb-4">"Berat badan saya berhasil turun 8 kg setelah mengikuti program di OBESIFIT.
                        Artikel dan videonya sangat membantu!"</p>
                    <div class="flex text-yellow-300">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimoni 2 -->
                <div class="testimonial-card text-white rounded-lg shadow-lg p-6 feature-card">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-primary text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Sari Dewi</h3>
                            <p class="text-green-100">Pengguna 6 bulan</p>
                        </div>
                    </div>
                    <p class="mb-4">"Kalkulator BMI sangat membantu saya memantau progress. Sekarang saya lebih paham
                        cara menjaga pola makan yang sehat."</p>
                    <div class="flex text-yellow-300">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>

                <!-- Testimoni 3 -->
                <div class="testimonial-card text-white rounded-lg shadow-lg p-6 feature-card">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-primary text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Budi Santoso</h3>
                            <p class="text-green-100">Pengguna 1 tahun</p>
                        </div>
                    </div>
                    <p class="mb-4">"Forum diskusinya sangat supportif. Saya bisa berbagi pengalaman dan mendapatkan
                        motivasi dari pengguna lain."</p>
                    <div class="flex text-yellow-300">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Memulai Perjalanan Sehat Anda?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Bergabunglah dengan OBESIFIT sekarang dan dapatkan akses ke semua
                fitur edukasi obesitas secara gratis!</p>
            <a href="#"
                class="px-8 py-3 bg-white text-primary font-bold rounded-lg hover:bg-gray-100 transition text-lg">Daftar
                Sekarang</a>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Hubungi Kami</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mt-4">Punya pertanyaan atau butuh bantuan? Jangan
                    ragu untuk menghubungi kami</p>
            </div>

            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8">
                    <form class="bg-white rounded-lg p-6 shadow-md">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 mb-2">Email</label>
                            <input type="email" id="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 mb-2">Pesan</label>
                            <textarea id="message" rows="5"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-secondary transition">Kirim
                            Pesan</button>
                    </form>
                </div>

                <div class="md:w-1/2 md:pl-8">
                    <div class="bg-white rounded-lg p-6 shadow-md h-full">
                        <h3 class="text-xl font-bold text-dark mb-6">Informasi Kontak</h3>

                        <div class="flex items-start mb-6">
                            <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark">Alamat</h4>
                                <p class="text-gray-600">Jl. Kesehatan No. 123, Jakarta Pusat, Indonesia</p>
                            </div>
                        </div>

                        <div class="flex items-start mb-6">
                            <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark">Telepon</h4>
                                <p class="text-gray-600">+62 21 1234 5678</p>
                            </div>
                        </div>

                        <div class="flex items-start mb-6">
                            <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark">Email</h4>
                                <p class="text-gray-600">info@obesifit.com</p>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h4 class="font-bold text-dark mb-4">Ikuti Kami</h4>
                            <div class="flex space-x-4">
                                <a href="#"
                                    class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white hover:bg-secondary">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white hover:bg-secondary">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white hover:bg-secondary">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white hover:bg-secondary">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center mr-2">
                            <i class="fas fa-heartbeat text-white"></i>
                        </div>
                        <span class="text-xl font-bold">OBESIFIT</span>
                    </div>
                    <p class="text-gray-400 mt-2">Platform Edukasi Obesitas Interaktif</p>
                </div>

                <div class="text-center md:text-right">
                    <p class="text-gray-400">&copy; 2023 OBESIFIT. All rights reserved.</p>
                    <div class="mt-2">
                        <a href="#" class="text-gray-400 hover:text-white mx-2">Kebijakan Privasi</a>
                        <a href="#" class="text-gray-400 hover:text-white mx-2">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth scrolling for anchor links
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

                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobile-menu');
                    mobileMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
