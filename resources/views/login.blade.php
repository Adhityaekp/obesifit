<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBESIFIT - Login & Register</title>
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
        .auth-bg {
            background: linear-gradient(135deg, #4EAC92 0%, #3A8C74 50%, #2C6B58 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .tab-active {
            background-color: #4EAC92;
            color: white;
        }
    </style>
</head>

<body class="font-poppins bg-light">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-heartbeat text-white text-xl"></i>
                </div>
                <span class="text-xl font-bold text-dark">OBESIFIT</span>
            </div>
            <a href="/" class="text-primary hover:text-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
            </a>
        </div>
    </header>

    <main class="min-h-screen flex items-center justify-center py-12 px-4">
        <!-- Login Container -->
        <div id="login-container" class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Left Side - Illustration -->
                <div class="md:w-1/2 auth-bg text-white p-8 md:p-12 flex flex-col justify-center">
                    <div class="text-center md:text-left">
                        <h2 class="text-3xl font-bold mb-4">Selamat Datang Kembali!</h2>
                        <p class="text-green-100 mb-6">Masuk ke akun OBESIFIT Anda untuk mengakses semua fitur edukasi
                            obesitas yang tersedia.</p>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-article text-white"></i>
                                </div>
                                <span>Akses artikel kesehatan terbaru</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-video text-white"></i>
                                </div>
                                <span>Tonton video edukasi eksklusif</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-calculator text-white"></i>
                                </div>
                                <span>Gunakan kalkulator BMI</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-comments text-white"></i>
                                </div>
                                <span>Bergabung dengan forum diskusi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div class="md:w-1/2 p-8 md:p-12">
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-dark mb-2">Masuk ke OBESIFIT</h1>
                        <p class="text-gray-600">Silakan masuk dengan akun Anda</p>
                    </div>

                    <form id="login-form" class="space-y-6">
                        <div>
                            <label for="login-email" class="block text-gray-700 mb-2">Email</label>
                            <input type="email" id="login-email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="nama@email.com" required>
                        </div>

                        <div>
                            <label for="login-password" class="block text-gray-700 mb-2">Kata Sandi</label>
                            <input type="password" id="login-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="Masukkan kata sandi" required>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember-me"
                                    class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                                <label for="remember-me" class="ml-2 text-gray-700">Ingat saya</label>
                            </div>
                            <a href="/forgot" class="text-primary hover:text-secondary">Lupa kata sandi?</a>
                        </div>

                        <button type="submit"
                            class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-secondary transition">Masuk</button>

                        <div class="text-center">
                            <p class="text-gray-600">Belum punya akun?
                                <a href="#" id="show-register"
                                    class="text-primary font-medium hover:text-secondary">Daftar di sini</a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Register Container -->
        <div id="register-container" class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Left Side - Illustration -->
                <div class="md:w-1/2 auth-bg text-white p-8 md:p-12 flex flex-col justify-center">
                    <div class="text-center md:text-left">
                        <h2 class="text-3xl font-bold mb-4">Bergabung dengan OBESIFIT!</h2>
                        <p class="text-green-100 mb-6">Daftar sekarang untuk mendapatkan akses penuh ke semua fitur
                            edukasi obesitas kami.</p>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user-md text-white"></i>
                                </div>
                                <span>Konsultasi dengan ahli gizi</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-chart-line text-white"></i>
                                </div>
                                <span>Pantau progress kesehatan</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                                <span>Komunitas yang supportif</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-award text-white"></i>
                                </div>
                                <span>Program personalisasi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Register Form -->
                <div class="md:w-1/2 p-8 md:p-12">
                    <div class="text-center mb-6">
                        <h1 class="text-3xl font-bold text-dark mb-2">Daftar OBESIFIT</h1>
                        <p class="text-gray-600">Pilih jenis akun yang ingin Anda buat</p>
                    </div>

                    <!-- Tab Selection -->
                    <div class="flex bg-gray-100 rounded-lg p-1 mb-6">
                        <button id="tab-user" class="flex-1 py-2 rounded-md font-medium tab-active">Pengguna</button>
                        <button id="tab-doctor" class="flex-1 py-2 rounded-md font-medium">Dokter/Ahli Gizi</button>
                    </div>

                    <!-- User Registration Form -->
                    <form id="register-user-form" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="user-firstname" class="block text-gray-700 mb-2">Nama Depan</label>
                                <input type="text" id="user-firstname"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                    placeholder="Nama depan" required>
                            </div>
                            <div>
                                <label for="user-lastname" class="block text-gray-700 mb-2">Nama Belakang</label>
                                <input type="text" id="user-lastname"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                    placeholder="Nama belakang" required>
                            </div>
                        </div>

                        <div>
                            <label for="user-email" class="block text-gray-700 mb-2">Email</label>
                            <input type="email" id="user-email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="nama@email.com" required>
                        </div>

                        <div>
                            <label for="user-phone" class="block text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" id="user-phone"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="08xxxxxxxxxx" required>
                        </div>

                        <div>
                            <label for="user-password" class="block text-gray-700 mb-2">Kata Sandi</label>
                            <input type="password" id="user-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="Minimal 8 karakter" required>
                        </div>

                        <div>
                            <label for="user-confirm-password" class="block text-gray-700 mb-2">Konfirmasi Kata
                                Sandi</label>
                            <input type="password" id="user-confirm-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="Ulangi kata sandi" required>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="user-terms"
                                class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary" required>
                            <label for="user-terms" class="ml-2 text-gray-700 text-sm">
                                Saya menyetujui <a href="#" class="text-primary hover:text-secondary">Syarat &
                                    Ketentuan</a> dan <a href="#"
                                    class="text-primary hover:text-secondary">Kebijakan Privasi</a>
                            </label>
                        </div>

                        <button type="submit"
                            class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-secondary transition">Daftar
                            sebagai Pengguna</button>
                    </form>

                    <!-- Doctor Registration Form -->
                    <form id="register-doctor-form" class="space-y-4 hidden">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="doctor-firstname" class="block text-gray-700 mb-2">Nama Depan</label>
                                <input type="text" id="doctor-firstname"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                    placeholder="Nama depan" required>
                            </div>
                            <div>
                                <label for="doctor-lastname" class="block text-gray-700 mb-2">Nama Belakang</label>
                                <input type="text" id="doctor-lastname"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                    placeholder="Nama belakang" required>
                            </div>
                        </div>

                        <div>
                            <label for="doctor-email" class="block text-gray-700 mb-2">Email</label>
                            <input type="email" id="doctor-email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="nama@email.com" required>
                        </div>

                        <div>
                            <label for="doctor-specialization" class="block text-gray-700 mb-2">Spesialisasi</label>
                            <select id="doctor-specialization"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                required>
                                <option value="">Pilih spesialisasi</option>
                                <option value="gizi">Ahli Gizi</option>
                                <option value="dokter-umum">Dokter Umum</option>
                                <option value="dokter-spesialis">Dokter Spesialis</option>
                                <option value="dietisien">Dietisien</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label for="doctor-license" class="block text-gray-700 mb-2">Nomor Lisensi</label>
                            <input type="text" id="doctor-license"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="Nomor STR/SIP" required>
                        </div>

                        <div>
                            <label for="doctor-password" class="block text-gray-700 mb-2">Kata Sandi</label>
                            <input type="password" id="doctor-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="Minimal 8 karakter" required>
                        </div>

                        <div>
                            <label for="doctor-confirm-password" class="block text-gray-700 mb-2">Konfirmasi Kata
                                Sandi</label>
                            <input type="password" id="doctor-confirm-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="Ulangi kata sandi" required>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="doctor-terms"
                                class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary" required>
                            <label for="doctor-terms" class="ml-2 text-gray-700 text-sm">
                                Saya menyetujui <a href="#" class="text-primary hover:text-secondary">Syarat &
                                    Ketentuan</a> dan <a href="#"
                                    class="text-primary hover:text-secondary">Kebijakan Privasi</a>
                            </label>
                        </div>

                        <button type="submit"
                            class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-secondary transition">Daftar
                            sebagai Dokter/Ahli Gizi</button>
                    </form>

                    <div class="text-center mt-6">
                        <p class="text-gray-600">Sudah punya akun?
                            <a href="#" id="show-login"
                                class="text-primary font-medium hover:text-secondary">Masuk di sini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Toggle between Login and Register
        document.getElementById('show-register').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('login-container').classList.add('hidden');
            document.getElementById('register-container').classList.remove('hidden');
        });

        document.getElementById('show-login').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('register-container').classList.add('hidden');
            document.getElementById('login-container').classList.remove('hidden');
        });

        // Toggle between User and Doctor registration
        document.getElementById('tab-user').addEventListener('click', function() {
            document.getElementById('tab-user').classList.add('tab-active');
            document.getElementById('tab-doctor').classList.remove('tab-active');
            document.getElementById('register-user-form').classList.remove('hidden');
            document.getElementById('register-doctor-form').classList.add('hidden');
        });

        document.getElementById('tab-doctor').addEventListener('click', function() {
            document.getElementById('tab-doctor').classList.add('tab-active');
            document.getElementById('tab-user').classList.remove('tab-active');
            document.getElementById('register-doctor-form').classList.remove('hidden');
            document.getElementById('register-user-form').classList.add('hidden');
        });

        // Form validation and submission
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add login logic here
            alert('Login berhasil!');
        });

        document.getElementById('register-user-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add user registration logic here
            alert('Pendaftaran pengguna berhasil!');
        });

        document.getElementById('register-doctor-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add doctor registration logic here
            alert('Pendaftaran dokter/ahli gizi berhasil!');
        });
    </script>
</body>

</html>
