<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBESIFIT - Daftar Dokter/Ahli Gizi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
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
        <!-- Register Container -->
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Left Side - Illustration -->
                <div class="md:w-1/2 auth-bg text-white p-8 md:p-12 flex flex-col justify-center">
                    <div class="text-center md:text-left">
                        <h2 class="text-3xl font-bold mb-4">Bergabung sebagai Tenaga Medis!</h2>
                        <p class="text-green-100 mb-6">Daftar sebagai dokter atau ahli gizi untuk membantu masyarakat
                            dalam mengatasi masalah obesitas.</p>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-stethoscope text-white"></i>
                                </div>
                                <span>Berikan konsultasi medis</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user-friends text-white"></i>
                                </div>
                                <span>Kelola pasien secara online</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-heartbeat text-white"></i>
                                </div>
                                <span>Pantau progress pasien</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-graduation-cap text-white"></i>
                                </div>
                                <span>Akses materi edukasi terbaru</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Register Form -->
                <div class="md:w-1/2 p-8 md:p-12">
                    <div class="text-center mb-6">
                        <h1 class="text-3xl font-bold text-dark mb-2">Daftar sebagai Dokter/Ahli Gizi</h1>
                        <p class="text-gray-600">Isi data profesional Anda untuk bergabung dengan OBESIFIT</p>
                    </div>

                    <!-- Navigation Tabs -->
                    <div class="flex bg-gray-100 rounded-lg p-1 mb-6">
                        <a href="{{ route('register') }}"
                            class="flex-1 py-2 rounded-md font-medium text-center">Pengguna</a>
                        <a href="{{ route('register.doctor') }}"
                            class="flex-1 py-2 rounded-md font-medium text-center tab-active">Dokter/Ahli Gizi</a>
                    </div>

                    <!-- Doctor Registration Form -->
                    <form method="POST" action="{{ route('register.doctor') }}" class="space-y-4">
                        @csrf

                        <input type="hidden" name="role" value="doctor">

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-gray-700 mb-2">Nama Depan</label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('first_name') border-red-500 @enderror"
                                    placeholder="Nama depan" required>
                                @error('first_name')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-gray-700 mb-2">Nama Belakang</label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('last_name') border-red-500 @enderror"
                                    placeholder="Nama belakang" required>
                                @error('last_name')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('email') border-red-500 @enderror"
                                placeholder="nama@email.com" required>
                            @error('email')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('phone') border-red-500 @enderror"
                                placeholder="08xxxxxxxxxx" required>
                            @error('phone')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="specialization" class="block text-gray-700 mb-2">Spesialisasi</label>
                            <select name="specialization" id="specialization"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('specialization') border-red-500 @enderror"
                                required>
                                <option value="">Pilih spesialisasi</option>
                                <option value="gizi" {{ old('specialization') == 'gizi' ? 'selected' : '' }}>Ahli
                                    Gizi
                                </option>
                                <option value="dokter-umum"
                                    {{ old('specialization') == 'dokter-umum' ? 'selected' : '' }}>
                                    Dokter Umum</option>
                                <option value="dokter-spesialis"
                                    {{ old('specialization') == 'dokter-spesialis' ? 'selected' : '' }}>Dokter
                                    Spesialis
                                </option>
                                <option value="dietisien"
                                    {{ old('specialization') == 'dietisien' ? 'selected' : '' }}>
                                    Dietisien</option>
                                <option value="lainnya" {{ old('specialization') == 'lainnya' ? 'selected' : '' }}>
                                    Lainnya
                                </option>
                            </select>
                            @error('specialization')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="license_number" class="block text-gray-700 mb-2">Nomor Lisensi</label>
                            <input type="text" name="license_number" id="license_number"
                                value="{{ old('license_number') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('license_number') border-red-500 @enderror"
                                placeholder="Nomor STR/SIP" required>
                            @error('license_number')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-gray-700 mb-2">Kata Sandi</label>
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('password') border-red-500 @enderror"
                                placeholder="Minimal 8 karakter" required minlength="8">
                            @error('password')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-gray-700 mb-2">Konfirmasi Kata
                                Sandi</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="Ulangi kata sandi" required minlength="8">
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="terms" id="terms"
                                class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary" required>
                            <label for="terms" class="ml-2 text-gray-700 text-sm">
                                Saya menyetujui <a href="#" class="text-primary hover:text-secondary">Syarat &
                                    Ketentuan</a> dan <a href="#"
                                    class="text-primary hover:text-secondary">Kebijakan Privasi</a>
                            </label>
                            @error('terms')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-secondary transition">Daftar
                            sebagai Dokter/Ahli Gizi</button>
                    </form>


                    <div class="text-center mt-6">
                        <p class="text-gray-600">Sudah punya akun?
                            <a href="login.html" class="text-primary font-medium hover:text-secondary">Masuk di
                                sini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('register-doctor-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const password = document.getElementById('doctor-password').value;
            const confirmPassword = document.getElementById('doctor-confirm-password').value;
            const license = document.getElementById('doctor-license').value;
            const specialization = document.getElementById('doctor-specialization').value;

            if (password !== confirmPassword) {
                alert('Konfirmasi kata sandi tidak sesuai!');
                return;
            }

            if (password.length < 8) {
                alert('Kata sandi harus minimal 8 karakter!');
                return;
            }

            if (!license) {
                alert('Nomor lisensi harus diisi!');
                return;
            }

            if (!specialization) {
                alert('Spesialisasi harus dipilih!');
                return;
            }

            // Add doctor registration logic here
            alert('Pendaftaran dokter/ahli gizi berhasil!');
            // Redirect ke halaman login atau dashboard
            // window.location.href = 'login.html';
        });
    </script>
</body>

</html>
