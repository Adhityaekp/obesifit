<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - OBESIFIT</title>
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
        .admin-card {
            transition: all 0.3s ease;
        }

        .admin-card:hover {
            transform: translateY(-5px);
        }

        .active-tab {
            background-color: #4EAC92;
            color: white;
        }

        .sidebar-active {
            background-color: #4EAC92;
            color: white;
        }

        .stat-card {
            background: linear-gradient(135deg, #4EAC92, #3A8C74);
            color: white;
        }

        .table-row-hover:hover {
            background-color: #F0F9F6;
        }
    </style>
</head>

<body class="font-poppins bg-light">
    <!-- Navbar Admin -->
    <nav class="bg-white shadow-sm fixed w-full top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="/admin" class="flex items-center">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center mr-2">
                            <i class="fas fa-heartbeat text-white"></i>
                        </div>
                        <span class="text-xl font-bold text-dark">OBESIFIT <span
                                class="text-sm bg-primary text-white px-2 py-1 rounded ml-2">Admin</span></span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="/admin" class="text-dark hover:text-primary transition">Dashboard</a>
                    <a href="/admin/users" class="text-dark hover:text-primary transition">Manajemen User</a>
                    <a href="/admin/content" class="text-dark hover:text-primary transition">Konten</a>
                    <a href="/admin/analytics" class="text-dark hover:text-primary transition">Analitik</a>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="/admin/notifications" class="text-dark hover:text-primary transition relative">
                        <i class="fas fa-bell"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                    </a>
                    <div class="flex items-center space-x-2 text-dark">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                            <i class="fas fa-user-shield text-white text-sm"></i>
                        </div>
                        <span>Admin</span>
                        <i class="fas fa-chevron-down text-sm"></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-20 pb-8">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-dark mb-2">Dashboard Admin</h1>
                <p class="text-gray-600">Kelola dan pantau aktivitas platform OBESIFIT</p>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="admin-card stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100">Total Pengguna</p>
                            <h3 class="text-3xl font-bold mt-2">2,847</h3>
                            <p class="text-green-100 text-sm mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>12% dari bulan lalu
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="admin-card stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100">Konten Aktif</p>
                            <h3 class="text-3xl font-bold mt-2">156</h3>
                            <p class="text-green-100 text-sm mt-1">
                                <i class="fas fa-plus mr-1"></i>5 baru minggu ini
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-file-alt text-white text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="admin-card stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100">Konsultasi</p>
                            <h3 class="text-3xl font-bold mt-2">42</h3>
                            <p class="text-green-100 text-sm mt-1">
                                <i class="fas fa-clock mr-1"></i>8 menunggu respon
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-comments text-white text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="admin-card stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100">Aktivitas</p>
                            <h3 class="text-3xl font-bold mt-2">1,284</h3>
                            <p class="text-green-100 text-sm mt-1">
                                <i class="fas fa-chart-line mr-1"></i>Aktif hari ini
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-chart-bar text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sidebar Menu -->
                <div class="lg:col-span-1">
                    <!-- Quick Actions -->
                    <div class="admin-card bg-white rounded-2xl shadow-sm p-6 mb-6">
                        <h3 class="text-lg font-bold text-dark mb-4">Aksi Cepat</h3>
                        <div class="space-y-3">
                            <button
                                class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-green-50 transition">
                                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                                    <i class="fas fa-plus text-white"></i>
                                </div>
                                <span class="font-medium text-dark">Tambah Konten Baru</span>
                            </button>

                            <button
                                class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-green-50 transition">
                                <div class="w-10 h-10 bg-secondary rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-plus text-white"></i>
                                </div>
                                <span class="font-medium text-dark">Kelola Pengguna</span>
                            </button>

                            <button
                                class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-green-50 transition">
                                <div class="w-10 h-10 bg-accent rounded-full flex items-center justify-center">
                                    <i class="fas fa-chart-pie text-white"></i>
                                </div>
                                <span class="font-medium text-dark">Lihat Laporan</span>
                            </button>

                            <button
                                class="w-full flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-green-50 transition">
                                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                                    <i class="fas fa-cog text-white"></i>
                                </div>
                                <span class="font-medium text-dark">Pengaturan Sistem</span>
                            </button>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="admin-card bg-white rounded-2xl shadow-sm p-6">
                        <h3 class="text-lg font-bold text-dark mb-4">Aktivitas Terbaru</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-8 h-8 bg-primary bg-opacity-10 rounded-full flex items-center justify-center mt-1">
                                    <i class="fas fa-user-plus text-primary text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-dark">User baru terdaftar</p>
                                    <p class="text-sm text-gray-600">Budi Santoso bergabung</p>
                                    <p class="text-xs text-gray-500">10 menit lalu</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-8 h-8 bg-secondary bg-opacity-10 rounded-full flex items-center justify-center mt-1">
                                    <i class="fas fa-file-alt text-secondary text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-dark">Konten baru dipublikasi</p>
                                    <p class="text-sm text-gray-600">Artikel "Diet Sehat"</p>
                                    <p class="text-xs text-gray-500">1 jam lalu</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-8 h-8 bg-accent bg-opacity-10 rounded-full flex items-center justify-center mt-1">
                                    <i class="fas fa-comment text-accent text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-dark">Konsultasi baru</p>
                                    <p class="text-sm text-gray-600">Pertanyaan dari Siti</p>
                                    <p class="text-xs text-gray-500">2 jam lalu</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-8 h-8 bg-primary bg-opacity-10 rounded-full flex items-center justify-center mt-1">
                                    <i class="fas fa-chart-line text-primary text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-dark">Laporan bulanan dibuat</p>
                                    <p class="text-sm text-gray-600">Analitik Oktober 2023</p>
                                    <p class="text-xs text-gray-500">Hari ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-2">
                    <!-- Tab Navigation -->
                    <div class="bg-white rounded-2xl shadow-sm mb-6">
                        <div class="flex border-b border-gray-200">
                            <button
                                class="tab-button active-tab flex-1 py-4 px-6 font-semibold rounded-tl-2xl transition-all"
                                data-tab="users">
                                <i class="fas fa-users mr-2"></i>Manajemen User
                            </button>
                            <button
                                class="tab-button flex-1 py-4 px-6 font-semibold text-gray-600 transition-all hover:text-gray-800"
                                data-tab="content">
                                <i class="fas fa-file-alt mr-2"></i>Manajemen Konten
                            </button>
                            <button
                                class="tab-button flex-1 py-4 px-6 font-semibold text-gray-600 rounded-tr-2xl transition-all hover:text-gray-800"
                                data-tab="analytics">
                                <i class="fas fa-chart-bar mr-2"></i>Analitik
                            </button>
                        </div>

                        <!-- Manajemen User Tab -->
                        <div id="users-tab" class="content-section p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-dark">Daftar Pengguna</h3>
                                <div class="flex space-x-3">
                                    <div class="relative">
                                        <input type="text" placeholder="Cari pengguna..."
                                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                    </div>
                                    <button
                                        class="px-4 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-secondary transition">
                                        <i class="fas fa-plus mr-2"></i>Tambah User
                                    </button>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">User</th>
                                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Status
                                            </th>
                                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Bergabung
                                            </th>
                                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Aktivitas
                                            </th>
                                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <tr class="table-row-hover">
                                            <td class="py-3 px-4">
                                                <div class="flex items-center space-x-3">
                                                    <div
                                                        class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                                        <i class="fas fa-user text-white text-sm"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-dark">Ahmad Budiman</div>
                                                        <div class="text-sm text-gray-600">ahmad@email.com</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span
                                                    class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Aktif</span>
                                            </td>
                                            <td class="py-3 px-4 text-sm text-gray-600">15 Okt 2023</td>
                                            <td class="py-3 px-4">
                                                <div class="text-sm text-gray-600">12 artikel dibaca</div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <div class="flex space-x-2">
                                                    <button class="text-primary hover:text-secondary">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="table-row-hover">
                                            <td class="py-3 px-4">
                                                <div class="flex items-center space-x-3">
                                                    <div
                                                        class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                                        <i class="fas fa-user text-white text-sm"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-dark">Siti Rahayu</div>
                                                        <div class="text-sm text-gray-600">siti@email.com</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span
                                                    class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
                                            </td>
                                            <td class="py-3 px-4 text-sm text-gray-600">20 Okt 2023</td>
                                            <td class="py-3 px-4">
                                                <div class="text-sm text-gray-600">8 video ditonton</div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <div class="flex space-x-2">
                                                    <button class="text-primary hover:text-secondary">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="table-row-hover">
                                            <td class="py-3 px-4">
                                                <div class="flex items-center space-x-3">
                                                    <div
                                                        class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                                        <i class="fas fa-user text-white text-sm"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-dark">Budi Santoso</div>
                                                        <div class="text-sm text-gray-600">budi@email.com</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span
                                                    class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Aktif</span>
                                            </td>
                                            <td class="py-3 px-4 text-sm text-gray-600">22 Okt 2023</td>
                                            <td class="py-3 px-4">
                                                <div class="text-sm text-gray-600">5 konsultasi</div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <div class="flex space-x-2">
                                                    <button class="text-primary hover:text-secondary">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Manajemen Konten Tab -->
                        <div id="content-tab" class="content-section hidden p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-dark">Manajemen Konten</h3>
                                <div class="flex space-x-3">
                                    <select
                                        class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                        <option>Semua Kategori</option>
                                        <option>Artikel</option>
                                        <option>Video</option>
                                        <option>Tips</option>
                                    </select>
                                    <button
                                        class="px-4 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-secondary transition">
                                        <i class="fas fa-plus mr-2"></i>Tambah Konten
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div
                                    class="admin-card border border-gray-200 rounded-lg p-4 hover:border-primary transition">
                                    <div class="flex justify-between items-start mb-3">
                                        <span
                                            class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Artikel</span>
                                        <div class="flex space-x-2">
                                            <button class="text-primary hover:text-secondary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <h4 class="font-semibold text-dark mb-2">10 Pola Makan Sehat untuk Keluarga</h4>
                                    <p class="text-sm text-gray-600 mb-3">Panduan lengkap pola makan sehat untuk
                                        seluruh keluarga...</p>
                                    <div class="flex justify-between items-center text-sm text-gray-500">
                                        <span>Dibuat: 15 Okt 2023</span>
                                        <span>1.2k dilihat</span>
                                    </div>
                                </div>

                                <div
                                    class="admin-card border border-gray-200 rounded-lg p-4 hover:border-primary transition">
                                    <div class="flex justify-between items-start mb-3">
                                        <span
                                            class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Video</span>
                                        <div class="flex space-x-2">
                                            <button class="text-primary hover:text-secondary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <h4 class="font-semibold text-dark mb-2">Olahraga Kardio untuk Pemula</h4>
                                    <p class="text-sm text-gray-600 mb-3">Video panduan olahraga kardio yang aman untuk
                                        pemula...</p>
                                    <div class="flex justify-between items-center text-sm text-gray-500">
                                        <span>Dibuat: 18 Okt 2023</span>
                                        <span>856 dilihat</span>
                                    </div>
                                </div>

                                <div
                                    class="admin-card border border-gray-200 rounded-lg p-4 hover:border-primary transition">
                                    <div class="flex justify-between items-start mb-3">
                                        <span
                                            class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">Tips</span>
                                        <div class="flex space-x-2">
                                            <button class="text-primary hover:text-secondary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <h4 class="font-semibold text-dark mb-2">Tips Menjaga Berat Badan Ideal</h4>
                                    <p class="text-sm text-gray-600 mb-3">Cara praktis menjaga berat badan ideal dalam
                                        kehidupan sehari-hari...</p>
                                    <div class="flex justify-between items-center text-sm text-gray-500">
                                        <span>Dibuat: 20 Okt 2023</span>
                                        <span>943 dilihat</span>
                                    </div>
                                </div>

                                <div
                                    class="admin-card border border-gray-200 rounded-lg p-4 hover:border-primary transition">
                                    <div class="flex justify-between items-start mb-3">
                                        <span
                                            class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Artikel</span>
                                        <div class="flex space-x-2">
                                            <button class="text-primary hover:text-secondary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <h4 class="font-semibold text-dark mb-2">Memahami Indeks Massa Tubuh (BMI)</h4>
                                    <p class="text-sm text-gray-600 mb-3">Penjelasan lengkap tentang BMI dan cara
                                        menghitungnya...</p>
                                    <div class="flex justify-between items-center text-sm text-gray-500">
                                        <span>Dibuat: 22 Okt 2023</span>
                                        <span>1.5k dilihat</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Analitik Tab -->
                        <div id="analytics-tab" class="content-section hidden p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-dark">Analitik Platform</h3>
                                <select
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option>Bulan Ini</option>
                                    <option>3 Bulan Terakhir</option>
                                    <option>Tahun Ini</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div class="admin-card bg-white border border-gray-200 rounded-lg p-6">
                                    <h4 class="font-semibold text-dark mb-4">Traffic Pengunjung</h4>
                                    <div class="h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <p class="text-gray-500">Grafik traffic pengunjung akan ditampilkan di sini</p>
                                    </div>
                                </div>

                                <div class="admin-card bg-white border border-gray-200 rounded-lg p-6">
                                    <h4 class="font-semibold text-dark mb-4">Distribusi Pengguna</h4>
                                    <div class="h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <p class="text-gray-500">Pie chart distribusi pengguna akan ditampilkan di sini
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="admin-card bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="font-semibold text-dark mb-4">Konten Populer</h4>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-dark">Memahami Indeks Massa Tubuh (BMI)
                                                </div>
                                                <div class="text-sm text-gray-600">1,542 views • 85% engagement</div>
                                            </div>
                                        </div>
                                        <div class="text-primary font-bold">95%</div>
                                    </div>

                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-10 h-10 bg-secondary rounded-full flex items-center justify-center">
                                                <i class="fas fa-video text-white"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-dark">Olahraga Kardio untuk Pemula</div>
                                                <div class="text-sm text-gray-600">1,210 views • 78% engagement</div>
                                            </div>
                                        </div>
                                        <div class="text-secondary font-bold">88%</div>
                                    </div>

                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-10 h-10 bg-accent rounded-full flex items-center justify-center">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-dark">10 Pola Makan Sehat untuk Keluarga
                                                </div>
                                                <div class="text-sm text-gray-600">987 views • 72% engagement</div>
                                            </div>
                                        </div>
                                        <div class="text-accent font-bold">82%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Status -->
                    <div class="admin-card bg-white rounded-2xl shadow-sm p-6">
                        <h3 class="text-lg font-bold text-dark mb-4">Status Sistem</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center p-4 border border-gray-200 rounded-lg">
                                <div
                                    class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-server text-green-600"></i>
                                </div>
                                <div class="font-semibold text-dark">Server</div>
                                <div class="text-sm text-green-600">Online</div>
                            </div>

                            <div class="text-center p-4 border border-gray-200 rounded-lg">
                                <div
                                    class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-database text-green-600"></i>
                                </div>
                                <div class="font-semibold text-dark">Database</div>
                                <div class="text-sm text-green-600">Stabil</div>
                            </div>

                            <div class="text-center p-4 border border-gray-200 rounded-lg">
                                <div
                                    class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-shield-alt text-green-600"></i>
                                </div>
                                <div class="font-semibold text-dark">Keamanan</div>
                                <div class="text-sm text-green-600">Aman</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-8">
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
                    <p class="text-gray-400">&copy; 2023 OBESIFIT. All rights reserved.</p>
                    <p class="text-gray-400 text-sm mt-1">Admin Panel v2.1.0</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Tab Navigation
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const contentSections = document.querySelectorAll('.content-section');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tab = this.getAttribute('data-tab');

                    // Update active tab
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active-tab');
                        btn.classList.add('text-gray-600');
                    });
                    this.classList.add('active-tab');
                    this.classList.remove('text-gray-600');

                    // Show corresponding content
                    contentSections.forEach(section => {
                        section.classList.add('hidden');
                    });
                    document.getElementById(`${tab}-tab`).classList.remove('hidden');
                });
            });

            // Quick Actions
            document.querySelectorAll('.admin-card button').forEach(button => {
                button.addEventListener('click', function() {
                    const action = this.querySelector('span').textContent;
                    alert(`Aksi: ${action}`);
                });
            });
        });
    </script>
</body>

</html>
