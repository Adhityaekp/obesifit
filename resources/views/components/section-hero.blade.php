<style>
    .floating {
        animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
        0% {
            transform: translate(0, 0px);
        }

        50% {
            transform: translate(0, -10px);
        }

        100% {
            transform: translate(0, -0px);
        }
    }

    .pulse-glow {
        animation: pulse-glow 2s ease-in-out infinite alternate;
    }

    @keyframes pulse-glow {
        from {
            box-shadow: 0 10px 25px -5px rgba(78, 172, 146, 0.2), 0 8px 10px -6px rgba(78, 172, 146, 0.1);
        }

        to {
            box-shadow: 0 20px 50px -12px rgba(78, 172, 146, 0.4), 0 8px 10px -6px rgba(78, 172, 146, 0.2);
        }
    }

    .gradient-border {
        background: linear-gradient(white, white) padding-box,
            linear-gradient(135deg, #4EAC92, #3A8C74) border-box;
        border: 2px solid transparent;
    }
</style>

<!-- components/section-hero.blade.php -->
<section id="beranda" class="relative bg-white pt-16 md:pt-20 pb-20 md:pb-28">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Main Background Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-green-50 via-white to-blue-50"></div>

        <!-- Abstract Shapes -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-primary bg-opacity-5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary bg-opacity-5 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-accent bg-opacity-3 rounded-full blur-3xl"></div>

        <!-- Grid Pattern -->
        <div class="absolute inset-0 opacity-[0.03]"
            style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"%234EAC92\" fill-opacity=\"0.1\"><circle cx=\"30\" cy=\"30\" r=\"2\"/></g></svg>')">
        </div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
            <!-- Text Content -->
            <div class="lg:w-1/2 text-center lg:text-left">
                <!-- Badge -->
                <div
                    class="inline-flex items-center px-4 py-2 bg-primary bg-opacity-10 text-primary rounded-full text-sm font-medium mb-6 border border-primary border-opacity-20">
                    <i class="fas fa-rocket text-primary mr-2"></i>
                    <span>Transformasi Kesehatan Dimulai di Sini</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-dark mb-6 leading-tight">
                    Selamat Datang,
                    <span class="text-primary block mt-2">{{ Auth::user()->first_name ?? 'Pengguna' }}!</span>
                </h1>

                @if (Auth::check() && Auth::user()->role === 'user')
                    @php
                        $activeSub = Auth::user()
                            ->subscriptions()
                            ->where('status', 'active')
                            ->where('end_date', '>', now())
                            ->latest('end_date')
                            ->first();
                    @endphp

                    @if ($activeSub)
                        <div
                            class="inline-flex items-center bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold mb-4">
                            <i class="fas fa-crown text-yellow-500 mr-2"></i> Langganan Aktif
                            ({{ $activeSub->plan_name }})
                        </div>
                    @else
                        <div
                            class="inline-flex items-center bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold mb-4">
                            <i class="fas fa-user-clock mr-2"></i> Belum Berlangganan
                        </div>
                    @endif
                @endif

                <!-- Description -->
                <p class="text-lg md:text-xl text-gray-600 mb-8 leading-relaxed max-w-2xl">
                    Mulai perjalanan sehat Anda dengan akses penuh ke
                    <span class="font-semibold text-primary">fitur premium</span>
                    dan program personalisasi dari OBESIFIT.
                </p>

                <!-- Feature Highlights -->
                <div class="flex flex-wrap gap-4 mb-8">
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-check-circle text-primary mr-2"></i>
                        <span class="text-sm">Kalkulator BMI Premium</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-check-circle text-primary mr-2"></i>
                        <span class="text-sm">Plan Makan Personal</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-check-circle text-primary mr-2"></i>
                        <span class="text-sm">Konsultasi Ahli Gizi</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    <!-- Berlangganan Button -->
                    @if (Auth::user()->role === 'user' && !$activeSub)
                        @if (!$activeSub)
                            <a href="#konsul_dokter"
                                class="group px-8 py-4 bg-primary text-white font-bold rounded-2xl hover:bg-secondary transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl flex items-center justify-center">
                                <i class="fas fa-crown text-yellow-300 mr-3"></i>
                                Berlangganan Sekarang
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        @endif
                    @endif

                    <!-- Fitur Button -->
                    <a href="#articles"
                        class="group px-8 py-4 bg-white text-primary font-bold border-2 border-primary border-opacity-30 rounded-2xl hover:bg-primary hover:text-white transition-all duration-300 transform hover:-translate-y-1 shadow-md hover:shadow-lg flex items-center justify-center">
                        <i class="fas fa-star mr-3"></i>
                        Lihat Semua Fitur
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="flex items-center justify-center lg:justify-start space-x-6 text-sm text-gray-500">
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt text-primary mr-2"></i>
                        <span>Terpercaya</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-users text-primary mr-2"></i>
                        <span>10K+ Pengguna</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-heart text-primary mr-2"></i>
                        <span>Ahli Bersertifikat</span>
                    </div>
                </div>
            </div>

            <!-- Image Content -->
            <div class="lg:w-1/2 flex justify-center">
                <div class="relative">
                    <!-- Main Image Container -->
                    <div class="relative bg-gradient-to-br from-primary to-secondary rounded-3xl p-1 shadow-2xl">
                        <div class="bg-white rounded-2xl p-6">
                            <img src="/img/Backgorund login.png" alt="Dashboard User"
                                class="rounded-xl w-full max-w-md transform hover:scale-105 transition-transform duration-300">
                        </div>

                        <!-- Floating Motivation Card (Top Left) -->
                        <div class="absolute -top-4 -left-4 bg-white rounded-2xl p-4 shadow-lg border border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-primary bg-opacity-10 rounded-full flex items-center justify-center">
                                    <span class="text-2xl">💪</span>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Motivasi Hari Ini</div>
                                    <div class="font-bold text-dark">Kamu Hebat!</div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Tip Card (Bottom Right) -->
                        <div
                            class="absolute -bottom-4 -right-4 bg-white rounded-2xl p-4 shadow-lg border border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-secondary bg-opacity-10 rounded-full flex items-center justify-center">
                                    <span class="text-2xl">🥗</span>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Tips Sehat</div>
                                    <div class="font-bold text-dark">Jangan lupa minum air!</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Achievement Badge -->
                    <div
                        class="absolute -top-2 -right-2 bg-accent text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg flex items-center">
                        <span class="mr-2">🌟</span> Selamat Datang!
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Wave Divider Bottom -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden transform rotate-180">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-16 md:h-20">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                class="fill-white"></path>
        </svg>
    </div>
</section>
