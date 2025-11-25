<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - OBESIFIT</title>
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
            transform: translateY(-2px);
        }

        .table-row-hover:hover {
            background-color: #F0F9F6;
        }

        .modal-content {
            animation: modalSlideUp 0.3s ease-out;
        }

        @keyframes modalSlideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .error-message {
            display: block;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body class="font-poppins bg-light">
    <!-- Navbar Admin -->
    @auth
        @include('components.admin-navbar')
    @endauth

    <section
        class="bg-gradient-to-br from-primary via-secondary to-accent text-white pt-12 pb-12 md:pt-28 md:pb-16 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="inline-block mb-4">
                <div
                    class="w-16 h-16 md:w-20 md:h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto backdrop-blur-sm">
                    <i class="fas fa-users text-3xl md:text-4xl"></i>
                </div>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight">Manajemen Pengguna</h1>
            <p class="text-base md:text-xl text-green-100 max-w-2xl mx-auto leading-relaxed">
                Kelola semua akun pengguna, dokter, dan administrator<br class="hidden md:block">
                dengan kontrol penuh atas verifikasi dan status
            </p>
        </div>
    </section>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="container mx-auto px-4 mt-20">
            <div
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.style.display='none'" class="text-green-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="container mx-auto px-4 mt-20">
            <div
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.style.display='none'" class="text-red-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="pt-10 pb-8">
        <div class="container mx-auto px-4">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Users -->
                <div class="admin-card bg-white rounded-2xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Total Pengguna</p>
                            <h3 class="text-3xl font-bold text-dark mt-2">{{ $totalUsers }}</h3>
                            <p class="text-gray-500 text-sm mt-1">Semua role</p>
                        </div>
                        <div class="w-12 h-12 bg-primary bg-opacity-10 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-primary text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Active Doctors -->
                <div class="admin-card bg-white rounded-2xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Dokter Aktif</p>
                            <h3 class="text-3xl font-bold text-dark mt-2">{{ $activeDoctors }}</h3>
                            <p class="text-gray-500 text-sm mt-1">Terverifikasi</p>
                        </div>
                        <div class="w-12 h-12 bg-green-500 bg-opacity-10 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-md text-green-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Pending Doctors -->
                <div class="admin-card bg-white rounded-2xl shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Menunggu Verifikasi</p>
                            <h3 class="text-3xl font-bold text-dark mt-2">{{ $pendingDoctorsCount }}</h3>
                            <p class="text-gray-500 text-sm mt-1">Dokter pending</p>
                        </div>
                        <div
                            class="w-12 h-12 bg-yellow-500 bg-opacity-10 rounded-full flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-500 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions untuk Dokter Pending -->
            @if ($pendingDoctors->count() > 0)
                <div class="mb-8">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-yellow-800 flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    Dokter Menunggu Verifikasi
                                </h3>
                                <p class="text-yellow-600 text-sm mt-1">Ada {{ $pendingDoctorsCount }} dokter yang perlu
                                    diverifikasi</p>
                            </div>
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $pendingDoctorsCount }} Pending
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($pendingDoctors as $doctor)
                                <div class="bg-white rounded-lg border border-yellow-200 p-4">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start space-x-3">
                                            <div
                                                class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-user-md text-yellow-600"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-dark">{{ $doctor->first_name }}
                                                    {{ $doctor->last_name }}</p>
                                                <p class="text-sm text-gray-600">
                                                    {{ $doctor->specialization ?? 'Spesialisasi belum diisi' }}</p>
                                                <p class="text-xs text-gray-500">
                                                    {{ $doctor->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex space-x-2 mt-3">
                                        <form action="{{ route('admin.verify-doctor', $doctor->id) }}" method="POST"
                                            class="flex-1">
                                            @csrf
                                            <button type="submit"
                                                class="w-full bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition duration-300 flex items-center justify-center">
                                                <i class="fas fa-check mr-1"></i>
                                                Verifikasi
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.reject-doctor', $doctor->id) }}" method="POST"
                                            class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition duration-300 flex items-center justify-center"
                                                onclick="return confirm('Tolak dokter {{ $doctor->first_name }} {{ $doctor->last_name }}?')">
                                                <i class="fas fa-times mr-1"></i>
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($pendingDoctorsCount > 5)
                            <div class="mt-4 text-center">
                                <a href="#pending-doctors"
                                    class="text-yellow-700 hover:text-yellow-800 text-sm font-medium inline-flex items-center">
                                    Lihat semua {{ $pendingDoctorsCount }} dokter pending
                                    <i class="fas fa-arrow-down ml-1"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Main Content Area -->
            <div class="bg-white rounded-2xl shadow-sm">
                <!-- Filter Section -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <h3 class="text-lg font-semibold text-dark">Daftar Pengguna</h3>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <!-- Search -->
                            <div class="relative">
                                <form method="GET" class="flex">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Cari pengguna..."
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary w-full sm:w-64">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                </form>
                            </div>

                            <!-- Filter Role -->
                            <form method="GET" class="flex">
                                <select name="role" onchange="this.form.submit()"
                                    class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary w-full sm:w-auto">
                                    <option value="">Semua Role</option>
                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User
                                    </option>
                                    <option value="doctor" {{ request('role') == 'doctor' ? 'selected' : '' }}>Doctor
                                    </option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                </select>
                            </form>

                            <!-- Filter Status -->
                            <form method="GET" class="flex">
                                <select name="status" onchange="this.form.submit()"
                                    class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary w-full sm:w-auto">
                                    <option value="">Semua Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                        Nonaktif</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">User</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Status</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Bergabung</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Role</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Verifikasi</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr class="table-row-hover">
                                        <td class="py-3 px-4">
                                            <div class="flex items-center space-x-3">
                                                <div
                                                    class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                                                    @if ($user->profile_photo)
                                                        <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                                            alt="Profile"
                                                            class="w-full h-full object-cover rounded-full">
                                                    @else
                                                        <i class="fas fa-user text-white text-sm"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="font-medium text-dark">{{ $user->first_name }}
                                                        {{ $user->last_name }}</div>
                                                    <div class="text-sm text-gray-600">{{ $user->email }}</div>
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
                                            <div class="flex items-center">
                                                <span
                                                    class="text-sm text-gray-600 capitalize">{{ $user->role }}</span>
                                                @if ($user->role === 'doctor')
                                                    <i class="fas fa-user-md text-primary ml-2 text-xs"></i>
                                                @elseif ($user->role === 'admin')
                                                    <i class="fas fa-user-shield text-red-500 ml-2 text-xs"></i>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- Verifikasi (Hanya untuk dokter yang belum aktif) -->
                                        <td class="py-3 px-4">
                                            @if ($user->role === 'doctor' && !$user->is_active)
                                                <div class="flex space-x-2">
                                                    <!-- Tombol Verifikasi -->
                                                    <form action="{{ route('admin.verify-doctor', $user->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit"
                                                            class="bg-primary hover:bg-secondary text-white px-3 py-1 rounded-lg text-xs font-medium transition duration-300 flex items-center"
                                                            onclick="return confirm('Verifikasi dokter {{ $user->first_name }} {{ $user->last_name }}?')">
                                                            <i class="fas fa-check mr-1"></i>
                                                            Verifikasi
                                                        </button>
                                                    </form>

                                                    <!-- Tombol Tolak -->
                                                    <form action="{{ route('admin.reject-doctor', $user->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs font-medium transition duration-300 flex items-center"
                                                            onclick="return confirm('Tolak dan hapus dokter {{ $user->first_name }} {{ $user->last_name }}?')">
                                                            <i class="fas fa-times mr-1"></i>
                                                            Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            @elseif ($user->role === 'doctor' && $user->is_active)
                                                <span class="text-green-600 text-sm font-medium">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    Terverifikasi
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-sm">-</span>
                                            @endif
                                        </td>

                                        <!-- Aksi -->
                                        <td class="py-3 px-4">
                                            <div class="flex space-x-2">
                                                <button onclick="openEditModal({{ $user->id }})"
                                                    class="text-primary hover:text-secondary transition p-2 rounded-lg hover:bg-gray-100"
                                                    title="Edit User">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button
                                                    onclick="openDeleteModal({{ $user->id }}, '{{ $user->first_name }} {{ $user->last_name }}')"
                                                    class="text-red-500 hover:text-red-700 transition p-2 rounded-lg hover:bg-gray-100"
                                                    title="Hapus User">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Empty State -->
                        @if ($users->isEmpty())
                            <div class="text-center py-12">
                                <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500 text-lg">Tidak ada pengguna ditemukan</p>
                                <p class="text-gray-400 text-sm mt-1">Coba ubah filter pencarian Anda</p>
                            </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $users->links() }}
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
                    <p class="text-gray-400">&copy; 2023 OBESIFIT. All rights reserved.</p>
                    <p class="text-gray-400 text-sm mt-1">Admin Panel v2.1.0</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
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
                        location.reload();
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
                        location.reload();
                    } else {
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
