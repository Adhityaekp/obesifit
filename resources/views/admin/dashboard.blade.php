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
    @auth
        @include('components.admin-navbar')
    @endauth

    <!-- Main Content -->
    <div class="pt-10 pb-8">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-dark mb-2">Dashboard Admin</h1>
                <p class="text-gray-600">Kelola dan pantau aktivitas platform OBESIFIT</p>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <!-- Pengguna Dokter -->
                <div class="admin-card stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100">Pengguna Dokter</p>
                            <h3 class="text-3xl font-bold mt-2">{{ $doctorCount }}</h3>
                            <p class="text-green-100 text-sm mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>Aktif terdaftar
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-md text-white text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Pengguna User -->
                <div class="admin-card stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100">Pengguna User</p>
                            <h3 class="text-3xl font-bold mt-2">{{ $userCount }}</h3>
                            <p class="text-green-100 text-sm mt-1">
                                <i class="fas fa-users mr-1"></i>Aktif terdaftar
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Konten Artikel -->
                <div class="admin-card stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100">Konten Artikel</p>
                            <h3 class="text-3xl font-bold mt-2">{{ $articleCount }}</h3>
                            <p class="text-green-100 text-sm mt-1">
                                <i class="fas fa-file-alt mr-1"></i>Total artikel
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-newspaper text-white text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Konten Video -->
                <div class="admin-card stat-card rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100">Konten Video</p>
                            <h3 class="text-3xl font-bold mt-2">{{ $videoCount }}</h3>
                            <p class="text-green-100 text-sm mt-1">
                                <i class="fas fa-play mr-1"></i>Total video
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-video text-white text-xl"></i>
                        </div>
                    </div>
                </div>

            </div>


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sidebar Menu -->
                <div class="lg:col-span-1">
                    <!-- Quick Actions -->
                    <div class="admin-card bg-white rounded-2xl shadow-sm p-6">
                        <h3 class="text-lg font-bold text-dark mb-4">Dokter Menunggu Verifikasi</h3>

                        <div class="space-y-4">
                            @forelse($pendingDoctors as $doctor)
                                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div
                                        class="w-8 h-8 bg-primary bg-opacity-10 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                                        <i class="fas fa-user-md text-primary text-sm"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium text-dark">{{ $doctor->first_name }}
                                            {{ $doctor->last_name }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ $doctor->specialization ?? 'Spesialisasi belum diisi' }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $doctor->created_at->diffForHumans() }}</p>

                                        <!-- Tombol Aksi -->
                                        <div class="flex space-x-2 mt-2">
                                            <!-- Tombol Verifikasi -->
                                            <form action="{{ route('admin.verify-doctor', $doctor->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-primary hover:bg-secondary text-white px-3 py-1 rounded-lg text-xs font-medium transition duration-300 flex items-center">
                                                    <i class="fas fa-check mr-1"></i>
                                                    Verifikasi
                                                </button>
                                            </form>

                                            <!-- Tombol Tolak -->
                                            <form action="{{ route('admin.reject-doctor', $doctor->id) }}"
                                                method="POST"
                                                onsubmit="return confirmReject('{{ $doctor->first_name }} {{ $doctor->last_name }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs font-medium transition duration-300 flex items-center">
                                                    <i class="fas fa-times mr-1"></i>
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 text-center py-4">Tidak ada dokter yang menunggu
                                    verifikasi.</p>
                            @endforelse
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
                                <i class="fas fa-file-alt mr-2"></i>Manajemen Konten Artikel
                            </button>
                            <button
                                class="tab-button flex-1 py-4 px-6 font-semibold text-gray-600 rounded-tr-2xl transition-all hover:text-gray-800"
                                data-tab="video">
                                <i class="fas fa-play mr-2"></i>Manajemen Konten Video
                            </button>
                        </div>

                        <!-- Manajemen User Tab -->
                        <div id="users-tab" class="content-section p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-dark">Daftar Pengguna</h3>
                                <div class="flex space-x-3">
                                    <!-- ✅ Search -->
                                    <div class="relative">
                                        <form method="GET">
                                            <input type="hidden" name="tab" value="users">
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                placeholder="Cari pengguna..."
                                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                        </form>
                                    </div>

                                    <!-- ✅ Filter Role -->
                                    <form method="GET">
                                        <input type="hidden" name="tab" value="content">
                                        <select name="role" onchange="this.form.submit()"
                                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary">
                                            <option value="">Semua Role</option>
                                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>
                                                User</option>
                                            <option value="doctor"
                                                {{ request('role') == 'doctor' ? 'selected' : '' }}>
                                                Doctor</option>
                                        </select>
                                    </form>
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
                                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Role
                                            </th>
                                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($users as $user)
                                            <tr class="table-row-hover">
                                                <td class="py-3 px-4">
                                                    <div class="flex items-center space-x-3">
                                                        <div
                                                            class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                                            <i class="fas fa-user text-white text-sm"></i>
                                                        </div>
                                                        <div>
                                                            <div class="font-medium text-dark">{{ $user->first_name }}
                                                                {{ $user->last_name }}</div>
                                                            <div class="text-sm text-gray-600">{{ $user->email }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Status -->
                                                <td class="py-3 px-4">
                                                    @if ($user->is_active)
                                                        <span
                                                            class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Aktif</span>
                                                    @else
                                                        <span
                                                            class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
                                                    @endif
                                                </td>

                                                <!-- Tanggal Bergabung -->
                                                <td class="py-3 px-4 text-sm text-gray-600">
                                                    {{ $user->created_at->format('d M Y') }}
                                                </td>

                                                <!-- Role -->
                                                <td class="py-3 px-4">
                                                    <div class="text-sm text-gray-600 capitalize">{{ $user->role }}
                                                    </div>
                                                </td>

                                                <!-- Aksi -->
                                                <td class="py-3 px-4">
                                                    <div class="flex space-x-2">
                                                        <button onclick="openEditModal({{ $user->id }})"
                                                            class="text-primary hover:text-secondary transition"
                                                            title="Edit User">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button
                                                            onclick="openDeleteModal({{ $user->id }}, '{{ $user->first_name }} {{ $user->last_name }}')"
                                                            class="text-red-500 hover:text-red-700 transition"
                                                            title="Hapus User">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="mt-4">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>

                        <!-- Manajemen Konten Tab -->
                        <div id="content-tab" class="content-section hidden p-6">

                            <!-- HEADER + FILTER -->
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-dark">Manajemen Artikel</h3>

                                <div class="flex space-x-3">
                                    <form method="GET">
                                        <input type="hidden" name="tab" value="content">
                                        <select name="category" id="categorySelect" onchange="this.form.submit()"
                                            class="w-full md:w-auto px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition bg-white">

                                            <option value="">Semua Kategori</option>

                                            <option value="Nutrition"
                                                {{ request('category') == 'Nutrition' ? 'selected' : '' }}>
                                                Nutrition
                                            </option>

                                            <option value="Exercise"
                                                {{ request('category') == 'Exercise' ? 'selected' : '' }}>
                                                Exercise
                                            </option>

                                            <option value="Mental Health"
                                                {{ request('category') == 'Mental Health' ? 'selected' : '' }}>
                                                Mental Health
                                            </option>

                                            <option value="Tips Sehat"
                                                {{ request('category') == 'Tips Sehat' ? 'selected' : '' }}>
                                                Tips Sehat
                                            </option>

                                            <option value="Obesitas"
                                                {{ request('category') == 'Obesitas' ? 'selected' : '' }}>
                                                Obesitas
                                            </option>
                                        </select>
                                    </form>
                                </div>
                            </div>

                            <!-- LIST ARTIKEL DINAMIS -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @forelse ($articles as $article)
                                    <a href="/articles/{{ $article->id }}"
                                        class="admin-card border border-gray-200 rounded-lg p-4 hover:border-primary transition block">
                                        <div class="flex justify-between items-start mb-3">
                                            <span
                                                class="px-2 py-1 text-xs rounded
                    @if ($article->category == 'Artikel') bg-blue-100 text-blue-800
                    @elseif($article->category == 'Video') bg-green-100 text-green-800
                    @else bg-purple-100 text-purple-800 @endif">
                                                {{ $article->category }}
                                            </span>
                                        </div>

                                        <h4 class="font-semibold text-dark mb-2">
                                            {{ $article->title }}
                                        </h4>

                                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                            {{ $article->excerpt }}
                                        </p>

                                        <div class="flex justify-between items-center text-sm text-gray-500">
                                            <div>
                                                <span class="font-medium">Oleh: {{ $article->user->first_name }}
                                                    {{ $article->user->last_name }}</span>
                                            </div>
                                            <span>{{ $article->created_at->format('d M Y') }}</span>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-gray-500 col-span-2 text-center">Tidak ada artikel.</p>
                                @endforelse
                            </div>

                            <!-- PAGINATION -->
                            <div class="mt-4">
                                {{ $articles->links() }}
                            </div>
                        </div>

                        <div id="video-tab" class="content-section hidden p-6">

                            <!-- HEADER + FILTER -->
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-dark">Manajemen Video</h3>

                                <div class="flex space-x-3">
                                    <form method="GET">
                                        <input type="hidden" name="tab" value="video">
                                        <select name="category" id="categorySelect" onchange="this.form.submit()"
                                            class="w-full md:w-auto px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary transition bg-white">

                                            <option value="">Semua Kategori</option>
                                            <option value="Nutrition"
                                                {{ request('category') == 'Nutrition' ? 'selected' : '' }}>Nutrition
                                            </option>
                                            <option value="Exercise"
                                                {{ request('category') == 'Exercise' ? 'selected' : '' }}>Exercise
                                            </option>
                                            <option value="Mental Health"
                                                {{ request('category') == 'Mental Health' ? 'selected' : '' }}>Mental
                                                Health</option>
                                            <option value="Tips Sehat"
                                                {{ request('category') == 'Tips Sehat' ? 'selected' : '' }}>Tips Sehat
                                            </option>
                                            <option value="Obesitas"
                                                {{ request('category') == 'Obesitas' ? 'selected' : '' }}>Obesitas
                                            </option>
                                        </select>
                                    </form>
                                </div>
                            </div>

                            <!-- LIST VIDEO DINAMIS -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @forelse ($videos as $video)
                                    <a href="/videos/{{ $video->id }}"
                                        class="admin-card border border-gray-200 rounded-lg p-4 hover:border-primary transition block">
                                        <div class="flex justify-between items-start mb-3">
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">
                                                {{ $video->category }}
                                            </span>
                                        </div>

                                        <h4 class="font-semibold text-dark mb-2">{{ $video->title }}</h4>

                                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                            {{ $video->excerpt }}
                                        </p>

                                        <div class="flex justify-between items-center text-sm text-gray-500">
                                            <div>
                                                <span class="font-medium">Oleh: {{ $video->creator->first_name }}
                                                    {{ $video->creator->last_name }}</span>
                                            </div>
                                            <span>{{ $video->created_at->format('d M Y') }}</span>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-gray-500 col-span-2 text-center">Tidak ada video.</p>
                                @endforelse
                            </div>

                            <!-- PAGINATION -->
                            <div class="mt-4">
                                {{ $videos->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl modal-content">
            <div class="bg-gradient-to-r from-primary to-secondary text-white p-5 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold">Edit User</h2>
                    <button onclick="closeEditModal()"
                        class="text-white hover:bg-white hover:bg-opacity-20 p-2 rounded-full transition">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>

            <form id="editUserForm" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <input type="hidden" id="edit_user_id" name="id">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="edit_first_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                            Depan</label>
                        <input type="text" id="edit_first_name" name="first_name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <span class="text-red-500 text-xs error-message" id="first_name_error"></span>
                    </div>
                    <div>
                        <label for="edit_last_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                            Belakang</label>
                        <input type="text" id="edit_last_name" name="last_name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <span class="text-red-500 text-xs error-message" id="last_name_error"></span>
                    </div>
                </div>

                <div>
                    <label for="edit_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="edit_email" name="email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    <span class="text-red-500 text-xs error-message" id="email_error"></span>
                </div>

                <div>
                    <label for="edit_phone" class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                    <input type="text" id="edit_phone" name="phone"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    <span class="text-red-500 text-xs error-message" id="phone_error"></span>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="edit_role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select id="edit_role" name="role"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="user">User</option>
                            <option value="doctor">Doctor</option>
                            <option value="admin">Admin</option>
                        </select>
                        <span class="text-red-500 text-xs error-message" id="role_error"></span>
                    </div>
                    <div>
                        <label for="edit_is_active"
                            class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="edit_is_active" name="is_active"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                        <span class="text-red-500 text-xs error-message" id="is_active_error"></span>
                    </div>
                </div>

                <div id="doctorFields" class="hidden space-y-4">
                    <div>
                        <label for="edit_specialization"
                            class="block text-sm font-medium text-gray-700 mb-1">Spesialisasi</label>
                        <input type="text" id="edit_specialization" name="specialization"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <span class="text-red-500 text-xs error-message" id="specialization_error"></span>
                    </div>
                    <div>
                        <label for="edit_license_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                            Lisensi</label>
                        <input type="text" id="edit_license_number" name="license_number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <span class="text-red-500 text-xs error-message" id="license_number_error"></span>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-secondary transition flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete User Modal -->
    <div id="deleteUserModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl modal-content">
            <div class="bg-gradient-to-r from-red-500 to-red-600 text-white p-5 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold">Konfirmasi Hapus</h2>
                    <button onclick="closeDeleteModal()"
                        class="text-white hover:bg-white hover:bg-opacity-20 p-2 rounded-full transition">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <i class="fas fa-exclamation-triangle text-4xl text-red-500 mr-3"></i>
                    <div>
                        <h3 class="font-semibold text-dark">Hapus User?</h3>
                        <p class="text-gray-600 text-sm mt-1">User: <span id="delete_user_name"
                                class="font-medium"></span></p>
                    </div>
                </div>

                <p class="text-red-600 text-sm mb-4 text-center">
                    <i class="fas fa-info-circle mr-1"></i>
                    Tindakan ini tidak dapat dibatalkan. Semua data user akan dihapus permanen.
                </p>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                        Batal
                    </button>
                    <button onclick="confirmDelete()"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition flex items-center">
                        <i class="fas fa-trash mr-2"></i>
                        Ya, Hapus
                    </button>
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

        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get("tab") || "users";

            document.querySelectorAll(".content-section").forEach(el => el.classList.add("hidden"));
            document.querySelectorAll(".tab-button").forEach(el => el.classList.remove("active-tab"));

            document.getElementById(activeTab + "-tab").classList.remove("hidden");
            document.querySelector(`[data-tab="${activeTab}"]`).classList.add("active-tab");
        });

        let currentUserId = null;

        // Edit Modal Functions
        function openEditModal(userId) {
            currentUserId = userId;

            // Reset error messages
            document.querySelectorAll('.error-message').forEach(el => {
                el.textContent = '';
            });

            // Fetch user data
            fetch(`/admin/users/${userId}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const user = data.user;

                        // Fill form fields
                        document.getElementById('edit_user_id').value = user.id;
                        document.getElementById('edit_first_name').value = user.first_name;
                        document.getElementById('edit_last_name').value = user.last_name;
                        document.getElementById('edit_email').value = user.email;
                        document.getElementById('edit_phone').value = user.phone || '';
                        document.getElementById('edit_role').value = user.role;
                        document.getElementById('edit_is_active').value = user.is_active ? '1' : '0';
                        document.getElementById('edit_specialization').value = user.specialization || '';
                        document.getElementById('edit_license_number').value = user.license_number || '';

                        // Show/hide doctor fields based on role
                        toggleDoctorFields(user.role);

                        // Show modal
                        document.getElementById('editUserModal').classList.remove('hidden');
                    } else {
                        alert('Gagal memuat data user');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat data user');
                });
        }

        function closeEditModal() {
            document.getElementById('editUserModal').classList.add('hidden');
            currentUserId = null;
        }

        function toggleDoctorFields(role) {
            const doctorFields = document.getElementById('doctorFields');
            if (role === 'doctor') {
                doctorFields.classList.remove('hidden');
            } else {
                doctorFields.classList.add('hidden');
            }
        }

        // Delete Modal Functions
        function openDeleteModal(userId, userName) {
            currentUserId = userId;
            document.getElementById('delete_user_name').textContent = userName;
            document.getElementById('deleteUserModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteUserModal').classList.add('hidden');
            currentUserId = null;
        }

        function confirmDelete() {
            if (!currentUserId) return;

            fetch(`/admin/users/${currentUserId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload(); // Reload page to reflect changes
                    } else {
                        alert(data.message);
                    }
                    closeDeleteModal();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus user');
                    closeDeleteModal();
                });
        }

        // Form Submission
        document.getElementById('editUserForm').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!currentUserId) return;

            const formData = new FormData(this);

            fetch(`/admin/users/${currentUserId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        closeEditModal();
                        location.reload(); // Reload page to reflect changes
                    } else {
                        // Display validation errors
                        if (data.errors) {
                            Object.keys(data.errors).forEach(field => {
                                const errorElement = document.getElementById(field + '_error');
                                if (errorElement) {
                                    errorElement.textContent = data.errors[field][0];
                                }
                            });
                        } else {
                            alert(data.message);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate user');
                });
        });

        // Show/hide doctor fields when role changes
        document.getElementById('edit_role').addEventListener('change', function() {
            toggleDoctorFields(this.value);
        });

        // Close modals when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.id === 'editUserModal') {
                closeEditModal();
            }
            if (e.target.id === 'deleteUserModal') {
                closeDeleteModal();
            }
        });
    </script>
</body>

</html>
