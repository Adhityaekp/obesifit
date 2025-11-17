<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - OBESIFIT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

        /* Profile Card Hover */
        .profile-card {
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
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
        .form-select,
        .form-textarea {
            transition: all 0.3s ease;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: #4EAC92;
            box-shadow: 0 0 0 3px rgba(78, 172, 146, 0.1);
        }

        /* Profile Photo Upload */
        .photo-upload-btn {
            transition: all 0.3s ease;
        }

        .photo-upload-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(78, 172, 146, 0.3);
        }

        /* Stat Card Gradient */
        .stat-card {
            background: linear-gradient(135deg, #4EAC92, #3A8C74);
            color: white;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(78, 172, 146, 0.3);
        }

        /* Package Card */
        .package-card {
            transition: all 0.3s ease;
            min-height: 420px;
            display: flex;
            flex-direction: column;
        }

        .package-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(78, 172, 146, 0.15);
        }

        .package-popular {
            position: relative;
            border: 2px solid #4EAC92;
            box-shadow: 0 0 0 3px rgba(78, 172, 146, 0.1);
        }

        .package-popular::before {
            content: "POPULER";
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #4EAC92, #3A8C74);
            color: white;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            z-index: 10;
            box-shadow: 0 4px 8px rgba(78, 172, 146, 0.3);
        }

        /* Swiper Customization */
        .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background-color: #9CA3AF;
            opacity: 0.5;
            transition: all 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            background-color: #4EAC92;
            opacity: 1;
            width: 24px;
            border-radius: 5px;
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

        /* Alert Styles */
        .alert {
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Badge Styles */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #4EAC92, #3A8C74);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(78, 172, 146, 0.3);
        }

        /* Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #F3F4F6;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #4EAC92;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #3A8C74;
        }

        /* Content Section Animation */
        .content-section {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-card:hover {
                transform: translateY(-3px);
            }
        }
    </style>
</head>

<body class="font-poppins bg-gradient-to-b from-gray-50 to-white">
    <!-- Navbar -->
    @auth
        @include('components.navbar-user')
    @endauth

    <!-- Hero Section - Compact -->
    <section
        class="bg-gradient-to-br from-primary via-secondary to-accent text-white pt-24 pb-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-user-circle text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">Profil Saya</h1>
                    <p class="text-sm md:text-base text-green-100">Kelola informasi profil dan preferensi Anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="py-8 md:py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                <!-- Sidebar Profil -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Profil Card -->
                    <div class="profile-card bg-white rounded-2xl shadow-lg p-6 text-center border border-gray-100">
                        <div class="relative inline-block mb-4">
                            <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('img/default-user.jpg') }}"
                                alt="Profil"
                                class="w-32 h-32 rounded-full object-cover mx-auto border-4 border-white shadow-lg"
                                id="previewPhoto">

                            <form id="photoForm" action="{{ route('profile.photo.update') }}" method="POST"
                                enctype="multipart/form-data" class="absolute bottom-2 right-2">
                                @csrf
                                @method('PUT')
                                <label for="photo"
                                    class="photo-upload-btn cursor-pointer w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center text-white shadow-lg">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <input type="file" name="photo" id="photo" accept="image/*" class="hidden"
                                    onchange="document.getElementById('photoForm').submit()">
                            </form>
                        </div>

                        <h2 class="text-xl font-bold text-dark mb-2">{{ Auth::user()->first_name }}</h2>

                        @if (Auth::user()->role === 'user')
                            @if (Auth::check())
                                @php
                                    $activeSub = Auth::user()
                                        ->subscriptions()
                                        ->where('status', 'active')
                                        ->where('end_date', '>', now())
                                        ->latest('end_date')
                                        ->first();
                                @endphp

                                @if ($activeSub)
                                    <div class="badge bg-green-100 text-green-700 mb-3">
                                        <i class="fas fa-crown text-yellow-500"></i>
                                        Langganan Aktif ({{ $activeSub->plan_name }})
                                    </div>
                                @else
                                    <div class="badge bg-gray-100 text-gray-700 mb-3">
                                        <i class="fas fa-user-clock"></i>
                                        Belum Berlangganan
                                    </div>
                                @endif
                            @endif
                        @endif

                        <p class="text-gray-600 text-sm">{{ Auth::user()->email }}</p>
                    </div>

                    @if (Auth::user()->isDoctor())
                        <!-- Overview Konsultasi -->
                        <div class="profile-card bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                            <h3 class="section-header text-lg font-bold text-dark mb-4">Overview Konsultasi</h3>

                            @php
                                $totalConsultations = Auth::user()->consultationsAsDoctor()->count();
                                $activeConsultations = Auth::user()
                                    ->consultationsAsDoctor()
                                    ->where('status', 'active')
                                    ->count();
                                $pendingConsultations = Auth::user()
                                    ->consultationsAsDoctor()
                                    ->where('status', 'pending')
                                    ->count();
                                $completedConsultations = Auth::user()
                                    ->consultationsAsDoctor()
                                    ->where('status', 'complete')
                                    ->count();
                                $ejectedConsultations = Auth::user()
                                    ->consultationsAsDoctor()
                                    ->where('status', 'rejected')
                                    ->count();
                                $recentPatients = Auth::user()->patients()->latest()->take(5)->get();
                            @endphp

                            <div class="grid grid-cols-2 gap-3 mb-6">
                                <div class="stat-card p-4 rounded-xl text-center">
                                    <div class="text-2xl font-bold">{{ $activeConsultations }}</div>
                                    <div class="text-xs opacity-90">Aktif</div>
                                </div>
                                <div class="p-4 bg-yellow-100 rounded-xl text-center">
                                    <div class="text-2xl font-bold text-yellow-700">{{ $pendingConsultations }}</div>
                                    <div class="text-xs text-yellow-600">Pending</div>
                                </div>
                                <div class="p-4 bg-blue-100 rounded-xl text-center">
                                    <div class="text-2xl font-bold text-blue-700">{{ $completedConsultations }}</div>
                                    <div class="text-xs text-blue-600">Selesai</div>
                                </div>
                                <div class="p-4 bg-gray-100 rounded-xl text-center">
                                    <div class="text-2xl font-bold text-gray-700">{{ $totalConsultations }}</div>
                                    <div class="text-xs text-gray-600">Total</div>
                                </div>
                            </div>

                            <h4 class="font-semibold text-dark mb-3 text-sm">Pasien Terbaru</h4>
                            <div class="space-y-2 max-h-48 overflow-y-auto custom-scrollbar">
                                @forelse($recentPatients as $patient)
                                    <div
                                        class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                {{ substr($patient->full_name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold text-sm text-dark">{{ $patient->full_name }}
                                                </div>
                                                <div class="text-xs text-gray-500">{{ $patient->email }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center text-gray-500 py-4 text-sm">Belum ada pasien</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Overview Konten Edukasi -->
                        <div class="profile-card bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                            <h3 class="section-header text-lg font-bold text-dark mb-4">Konten Edukasi</h3>

                            @php
                                $articlesCount = Auth::user()->articles()->count();
                                $videosCount = Auth::user()->educationalVideos()->count();
                            @endphp

                            <div class="grid grid-cols-2 gap-4">
                                <div
                                    class="p-4 bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl text-center hover:shadow-md transition">
                                    <i class="fas fa-newspaper text-3xl text-blue-600 mb-2"></i>
                                    <div class="text-2xl font-bold text-blue-700">{{ $articlesCount }}</div>
                                    <div class="text-xs text-blue-600">Artikel</div>
                                </div>
                                <div
                                    class="p-4 bg-gradient-to-br from-purple-100 to-purple-50 rounded-xl text-center hover:shadow-md transition">
                                    <i class="fas fa-video text-3xl text-purple-600 mb-2"></i>
                                    <div class="text-2xl font-bold text-purple-700">{{ $videosCount }}</div>
                                    <div class="text-xs text-purple-600">Video</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Paket Berlangganan -->
                    @if (Auth::user()->role === 'user')
                        @if (!$activeSub)
                            <div class="profile-card bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                                <h3 class="section-header text-lg font-bold text-dark mb-4">Pilih Paket</h3>

                                <div class="swiper-container relative overflow-hidden">
                                    <div class="swiper-wrapper mb-8">
                                        <!-- Paket Bulanan -->
                                        <div class="swiper-slide">
                                            <div class="package-card bg-white rounded-xl p-5 border-2 border-gray-200">
                                                <div class="text-center mb-4">
                                                    <h4 class="text-base font-bold text-dark mb-2">Bulanan</h4>
                                                    <div class="flex items-baseline justify-center">
                                                        <span class="text-3xl font-bold text-primary">Rp 99K</span>
                                                        <span class="text-gray-500 text-sm ml-2">/bulan</span>
                                                    </div>
                                                </div>
                                                <ul class="space-y-2 mb-4 text-xs text-gray-700">
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>2x konsultasi online</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>Chat unlimited 24/7</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>Artikel premium</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>Menu diet personal</span>
                                                    </li>
                                                </ul>
                                                <button onclick="selectPackage('bulanan')"
                                                    class="btn-primary w-full text-white py-2.5 rounded-xl font-semibold text-sm">
                                                    Pilih Paket
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Paket 3 Bulan -->
                                        <div class="swiper-slide">
                                            <div class="package-card package-popular bg-white rounded-xl p-5">
                                                <div class="text-center mb-4 mt-2">
                                                    <h4 class="text-base font-bold text-dark mb-2">3 Bulan</h4>
                                                    <div class="flex items-baseline justify-center">
                                                        <span class="text-3xl font-bold text-primary">Rp 249K</span>
                                                        <span class="text-gray-500 text-sm ml-2">/3bln</span>
                                                    </div>
                                                    <div class="text-green-600 font-semibold text-xs mt-1">Hemat 48K
                                                    </div>
                                                </div>
                                                <ul class="space-y-2 mb-4 text-xs text-gray-700">
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>6x konsultasi online</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>Chat unlimited 24/7</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>Semua fitur premium</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>Progress tracking</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>Rencana olahraga</span>
                                                    </li>
                                                </ul>
                                                <button onclick="selectPackage('3bulan')"
                                                    class="btn-primary w-full text-white py-2.5 rounded-xl font-semibold text-sm">
                                                    Pilih Paket
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Paket Tahunan -->
                                        <div class="swiper-slide">
                                            <div class="package-card bg-white rounded-xl p-5 border-2 border-gray-200">
                                                <div class="text-center mb-4">
                                                    <h4 class="text-base font-bold text-dark mb-2">Tahunan</h4>
                                                    <div class="flex items-baseline justify-center">
                                                        <span class="text-3xl font-bold text-primary">Rp 899K</span>
                                                        <span class="text-gray-500 text-sm ml-2">/tahun</span>
                                                    </div>
                                                    <div class="text-green-600 font-semibold text-xs mt-1">Hemat 289K
                                                    </div>
                                                </div>
                                                <ul class="space-y-2 mb-4 text-xs text-gray-700">
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>24x konsultasi online</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>Chat unlimited 24/7</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>Semua fitur premium</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>Konsultasi prioritas</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <i
                                                            class="fas fa-check text-primary mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>Laporan bulanan</span>
                                                    </li>
                                                </ul>
                                                <button onclick="selectPackage('tahunan')"
                                                    class="btn-primary w-full text-white py-2.5 rounded-xl font-semibold text-sm">
                                                    Pilih Paket
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        @endif
                    @endif

                    <!-- Riwayat Langganan -->
                    @if (Auth::user()->role === 'user')
                        <div class="profile-card bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                            <h3 class="section-header text-lg font-bold text-dark mb-4">Riwayat Langganan</h3>
                            <div class="space-y-3 max-h-64 overflow-y-auto custom-scrollbar">
                                @forelse ($subscriptions as $sub)
                                    <div
                                        class="p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-200 hover:shadow-md transition">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="font-bold text-dark">{{ $sub->plan_name }}</div>
                                            @if ($sub->status == 'active')
                                                <span class="badge bg-green-100 text-green-700 text-xs py-1 px-3">
                                                    <i class="fas fa-check-circle"></i> Aktif
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-xs text-gray-600">
                                            <i class="far fa-calendar mr-1"></i>
                                            {{ optional($sub->start_date)->format('d M Y') ?? '-' }} -
                                            {{ optional($sub->end_date)->format('d M Y') ?? '-' }}
                                        </div>
                                        <div class="text-sm font-bold text-primary mt-2">
                                            {{ $sub->price_formatted ?? $sub->price }}
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8">
                                        <i class="fas fa-inbox text-4xl text-gray-300 mb-2"></i>
                                        <p class="text-gray-500 text-sm">Belum ada riwayat langganan</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-2">
                    <!-- Tab Navigation -->
                    <div class="bg-white rounded-2xl shadow-lg mb-6 overflow-hidden border border-gray-100">
                        <div class="flex border-b border-gray-200">
                            <button
                                class="tab-button active-tab flex-1 py-4 px-4 md:px-6 font-semibold transition-all text-sm md:text-base"
                                data-tab="info">
                                <i class="fas fa-user mr-2"></i><span class="hidden sm:inline">Informasi
                                </span>Pribadi
                            </button>
                            @if (Auth::user()->role === 'user')
                                <button
                                    class="tab-button flex-1 py-4 px-4 md:px-6 font-semibold text-gray-600 transition-all text-sm md:text-base"
                                    data-tab="health">
                                    <i class="fas fa-heartbeat mr-2"></i><span class="hidden sm:inline">Data
                                    </span>Kesehatan
                                </button>
                            @endif
                            <button
                                class="tab-button flex-1 py-4 px-4 md:px-6 font-semibold text-gray-600 transition-all text-sm md:text-base"
                                data-tab="account">
                                <i class="fas fa-key mr-2"></i><span class="hidden sm:inline">Pengaturan </span>Akun
                            </button>
                        </div>

                        <!-- Informasi Pribadi Tab -->
                        <div id="info-tab" class="content-section p-6 md:p-8">
                            @if (session('success'))
                                <div
                                    class="alert mb-6 p-4 bg-green-100 text-green-700 rounded-xl border-l-4 border-green-500 flex items-center gap-3">
                                    <i class="fas fa-check-circle text-xl"></i>
                                    <span class="font-medium">{{ session('success') }}</span>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div
                                    class="alert mb-6 p-4 bg-red-100 text-red-700 rounded-xl border-l-4 border-red-500">
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-exclamation-circle text-xl"></i>
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li class="font-medium">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-8">
                                    <h3 class="section-header text-xl font-bold text-dark mb-6">Informasi Dasar</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-user text-primary mr-1"></i>Nama Depan
                                            </label>
                                            <input type="text" name="first_name"
                                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                value="{{ old('first_name', Auth::user()->first_name) }}">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-user text-primary mr-1"></i>Nama Belakang
                                            </label>
                                            <input type="text" name="last_name"
                                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                value="{{ old('last_name', Auth::user()->last_name) }}">
                                        </div>

                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-envelope text-primary mr-1"></i>Email
                                            </label>
                                            <input type="email" name="email"
                                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition bg-gray-50"
                                                value="{{ old('email', Auth::user()->email) }}" readonly>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-phone text-primary mr-1"></i>Nomor Telepon
                                            </label>
                                            <input type="tel" name="phone"
                                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                value="{{ old('phone', Auth::user()->phone) }}"
                                                placeholder="08xxxxxxxxxx">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-calendar text-primary mr-1"></i>Tanggal Lahir
                                            </label>
                                            <input type="date" name="birth_date"
                                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                value="{{ old('birth_date', Auth::user()->birth_date) }}">
                                        </div>

                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-map-marker-alt text-primary mr-1"></i>Alamat
                                            </label>
                                            <textarea name="alamat"
                                                class="form-textarea w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition resize-none"
                                                rows="3" placeholder="Masukkan alamat lengkap">{{ old('alamat', Auth::user()->alamat) }}</textarea>
                                        </div>

                                        @if (Auth::check() && Auth::user()->isDoctor())
                                            <div class="md:col-span-2 mt-4">
                                                <h4 class="section-header text-lg font-bold text-dark mb-4">Informasi
                                                    Dokter</h4>
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                    <i class="fas fa-id-card text-primary mr-1"></i>Nomor Lisensi
                                                </label>
                                                <input type="text" name="license_number"
                                                    class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                    value="{{ old('license_number', Auth::user()->license_number) }}">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                    <i class="fas fa-user-md text-primary mr-1"></i>Spesialisasi
                                                </label>
                                                <input type="text" name="specialization"
                                                    class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                    value="{{ old('specialization', Auth::user()->specialization) }}">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                    <i class="fas fa-calendar-week text-primary mr-1"></i>Hari Praktek
                                                </label>
                                                <input type="text" name="practice_days"
                                                    class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                    placeholder="Senin, Rabu, Jum'at"
                                                    value="{{ old('practice_days', Auth::user()->practice_days) }}">
                                            </div>

                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                        <i class="fas fa-clock text-primary mr-1"></i>Jam Mulai
                                                    </label>
                                                    <input type="time" name="practice_start_time"
                                                        class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                        value="{{ old('practice_start_time', Auth::user()->practice_start_time) }}">
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                        <i class="fas fa-clock text-primary mr-1"></i>Jam Selesai
                                                    </label>
                                                    <input type="time" name="practice_end_time"
                                                        class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                        value="{{ old('practice_end_time', Auth::user()->practice_end_time) }}">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div
                                    class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t-2 border-gray-200">
                                    <button type="button"
                                        class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                                        <i class="fas fa-times mr-2"></i>Batal
                                    </button>
                                    <button type="submit"
                                        class="btn-primary px-6 py-3 text-white rounded-xl font-semibold">
                                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Data Kesehatan Tab -->
                        <div id="health-tab" class="content-section hidden p-6 md:p-8">
                            @if (session('success'))
                                <div
                                    class="alert mb-6 p-4 bg-green-100 text-green-700 rounded-xl border-l-4 border-green-500 flex items-center gap-3">
                                    <i class="fas fa-check-circle text-xl"></i>
                                    <span class="font-medium">{{ session('success') }}</span>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div
                                    class="alert mb-6 p-4 bg-red-100 text-red-700 rounded-xl border-l-4 border-red-500">
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-exclamation-circle text-xl"></i>
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li class="font-medium">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('user.health.update') }}#health" method="POST">
                                @csrf

                                <div class="mb-8">
                                    <h3 class="section-header text-xl font-bold text-dark mb-6">Data Kesehatan</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-ruler-vertical text-primary mr-1"></i>Tinggi Badan
                                                (cm)
                                            </label>
                                            <input type="number" name="height"
                                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                value="{{ old('height', $health->height ?? '') }}" placeholder="170">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-weight text-primary mr-1"></i>Berat Badan (kg)
                                            </label>
                                            <input type="number" name="weight"
                                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                value="{{ old('weight', $health->weight ?? '') }}" placeholder="65">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-tint text-primary mr-1"></i>Golongan Darah
                                            </label>
                                            <select name="blood_type"
                                                class="form-select w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition bg-white">
                                                <option value="">Pilih Golongan Darah</option>
                                                @foreach (['A', 'B', 'AB', 'O'] as $type)
                                                    <option value="{{ $type }}"
                                                        {{ old('blood_type', $health->blood_type ?? '') == $type ? 'selected' : '' }}>
                                                        {{ $type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-heartbeat text-primary mr-1"></i>Tekanan Darah
                                            </label>
                                            <input type="text" name="blood_pressure"
                                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                value="{{ old('blood_pressure', $health->blood_pressure ?? '') }}"
                                                placeholder="120/80">
                                        </div>

                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-file-medical text-primary mr-1"></i>Riwayat Penyakit
                                            </label>
                                            <textarea name="disease_history"
                                                class="form-textarea w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition resize-none"
                                                rows="3" placeholder="Contoh: Diabetes, Hipertensi">{{ old('disease_history', $health->disease_history ?? '') }}</textarea>
                                        </div>

                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-allergies text-primary mr-1"></i>Alergi
                                            </label>
                                            <textarea name="allergies"
                                                class="form-textarea w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition resize-none"
                                                rows="2" placeholder="Contoh: Seafood, Kacang">{{ old('allergies', $health->allergies ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-8">
                                    <h3 class="section-header text-xl font-bold text-dark mb-6">Target Kesehatan</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-bullseye text-primary mr-1"></i>Target Berat Badan
                                                (kg)
                                            </label>
                                            <input type="number" name="target_weight"
                                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                value="{{ old('target_weight', $health->target_weight ?? '') }}"
                                                placeholder="60">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-running text-primary mr-1"></i>Frekuensi Olahraga
                                                (x/minggu)
                                            </label>
                                            <input type="number" name="workout_frequency_per_week"
                                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                value="{{ old('workout_frequency_per_week', $health->workout_frequency_per_week ?? '') }}"
                                                placeholder="3">
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t-2 border-gray-200">
                                    <button type="button"
                                        class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                                        <i class="fas fa-times mr-2"></i>Batal
                                    </button>
                                    <button type="submit"
                                        class="btn-primary px-6 py-3 text-white rounded-xl font-semibold">
                                        <i class="fas fa-save mr-2"></i>Simpan Data Kesehatan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Pengaturan Akun Tab -->
                        <div id="account-tab" class="content-section hidden p-6 md:p-8">
                            @if (session('success'))
                                <div
                                    class="alert mb-6 p-4 bg-green-100 text-green-700 rounded-xl border-l-4 border-green-500 flex items-center gap-3">
                                    <i class="fas fa-check-circle text-xl"></i>
                                    <span class="font-medium">{{ session('success') }}</span>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div
                                    class="alert mb-6 p-4 bg-red-100 text-red-700 rounded-xl border-l-4 border-red-500">
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-exclamation-circle text-xl"></i>
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li class="font-medium">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('profile.change-password') }}">
                                @csrf

                                <div class="mb-8">
                                    <h3 class="section-header text-xl font-bold text-dark mb-6">Ubah Password</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-lock text-primary mr-1"></i>Password Lama
                                            </label>
                                            <input type="password" name="current_password"
                                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                placeholder="Masukkan password lama" required>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-key text-primary mr-1"></i>Password Baru
                                            </label>
                                            <input type="password" name="new_password"
                                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                placeholder="Minimal 8 karakter" required>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-key text-primary mr-1"></i>Konfirmasi Password
                                            </label>
                                            <input type="password" name="new_password_confirmation"
                                                class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition"
                                                placeholder="Ulangi password baru" required>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="flex flex-col sm:flex-row justify-end gap-3 pb-8 border-b-2 border-gray-200">
                                    <button type="reset"
                                        class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                                        <i class="fas fa-times mr-2"></i>Batal
                                    </button>
                                    <button type="submit"
                                        class="btn-primary px-6 py-3 text-white rounded-xl font-semibold">
                                        <i class="fas fa-save mr-2"></i>Simpan Password Baru
                                    </button>
                                </div>
                            </form>

                            <!-- Delete Account Section -->
                            <form method="POST" action="{{ route('profile.delete-account') }}" class="mt-8"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')

                                <div class="bg-red-50 border-2 border-red-200 rounded-xl p-6">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-lg font-bold text-red-600 mb-2">Zona Berbahaya</h3>
                                            <p class="text-sm text-red-700 mb-4">
                                                Menghapus akun akan menghapus semua data profil, riwayat, dan informasi
                                                pribadi Anda secara permanen.
                                                Tindakan ini tidak dapat dibatalkan.
                                            </p>
                                            <button type="submit"
                                                class="px-6 py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition">
                                                <i class="fas fa-trash mr-2"></i>Hapus Akun Saya
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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

    <!-- SwiperJS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Midtrans Snap -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script>
        // Initialize Swiper
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: false,
            autoplay: false,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 1
                },
                1024: {
                    slidesPerView: 1
                },
            }
        });

        // Tab Navigation
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const contentSections = document.querySelectorAll('.content-section');

            function openTab(tab) {
                tabButtons.forEach(btn => {
                    const isActive = btn.getAttribute('data-tab') === tab;
                    btn.classList.toggle('active-tab', isActive);
                    btn.classList.toggle('text-gray-600', !isActive);
                });
                contentSections.forEach(section => {
                    section.classList.toggle('hidden', section.id !== `${tab}-tab`);
                });
            }

            // Open tab based on hash
            const hash = window.location.hash.replace('#', '');
            if (hash) openTab(hash);

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tab = this.getAttribute('data-tab');
                    openTab(tab);
                    history.replaceState(null, null, `#${tab}`);
                });
            });

            // Health suggestions
            const height = document.querySelector('input[name="height"]');
            const weight = document.querySelector('input[name="weight"]');
            const bp = document.querySelector('input[name="blood_pressure"]');
            const targetWeight = document.querySelector('input[name="target_weight"]');
            const workoutFreq = document.querySelector('input[name="workout_frequency_per_week"]');

            function suggestTargets() {
                if (!height || !weight || !height.value || !weight.value) return;

                fetch('{{ route('user.health.suggest') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            height: height.value,
                            weight: weight.value,
                            blood_pressure: bp ? bp.value : null
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (targetWeight && data.target_weight) targetWeight.value = data.target_weight;
                        if (workoutFreq && data.workout_frequency_per_week) workoutFreq.value = data
                            .workout_frequency_per_week;
                        if (data.advice) alert(data.advice);
                    })
                    .catch(err => console.error(err));
            }

            if (height && weight) {
                [height, weight, bp].forEach(el => {
                    if (el) {
                        el.addEventListener('change', suggestTargets);
                        el.addEventListener('blur', suggestTargets);
                    }
                });
            }
        });

        // Package Selection with Midtrans
        function selectPackage(packageName) {
            fetch("/subscribe", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        package: packageName
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.snapToken) {
                        window.snap.pay(data.snapToken, {
                            onSuccess: function(result) {
                                fetch("/subscription/update-status", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute('content')
                                        },
                                        body: JSON.stringify({
                                            order_id: result.order_id,
                                            status: "active"
                                        })
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                        if (data.success) {
                                            showSuccessModal();
                                        } else {
                                            alert("Gagal memperbarui status langganan.");
                                        }
                                    })
                                    .catch(err => console.error(err));
                            },
                            onPending: function(result) {
                                alert("Pembayaran tertunda. Silakan selesaikan pembayaran Anda.");
                            },
                            onError: function(result) {
                                alert("Pembayaran gagal. Silakan coba lagi.");
                            }
                        });
                    } else {
                        alert(data.message || "Gagal memulai pembayaran.");
                    }
                })
                .catch(err => console.error(err));
        }

        // Success Modal
        function showSuccessModal() {
            const modal = document.createElement('div');
            modal.id = 'success-modal';
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            modal.innerHTML = `
                <div class="bg-white p-8 rounded-2xl shadow-2xl text-center max-w-sm mx-4 animate-fadeIn">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-green-600 mb-2">Berhasil Berlangganan!</h2>
                    <p class="text-gray-600 mb-6">Langganan Anda telah aktif. Nikmati semua fitur premium sekarang!</p>
                    <button onclick="closeSuccessModal()" class="btn-primary w-full text-white px-6 py-3 rounded-xl font-semibold">
                        <i class="fas fa-check mr-2"></i>Oke, Mengerti
                    </button>
                </div>
            `;
            document.body.appendChild(modal);
        }

        function closeSuccessModal() {
            const modal = document.getElementById('success-modal');
            if (modal) modal.remove();
            location.reload();
        }
    </script>
</body>

</html>
