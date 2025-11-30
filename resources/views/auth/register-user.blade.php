<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBESIFIT - Daftar Pengguna</title>
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

        .error-message {
            background-color: #FEF2F2;
            border: 1px solid #FECACA;
            color: #DC2626;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .success-message {
            background-color: #F0FDF4;
            border: 1px solid #BBF7D0;
            color: #16A34A;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
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
        <!-- Register Container -->
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden">
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
                                    <i class="fas fa-user-friends text-white"></i>
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
                        <h1 class="text-3xl font-bold text-dark mb-2">Daftar sebagai Pengguna</h1>
                        <p class="text-gray-600">Isi data diri Anda untuk mulai menggunakan OBESIFIT</p>
                    </div>

                    <!-- Navigation Tabs -->
                    <div class="flex bg-gray-100 rounded-lg p-1 mb-6">
                        <a href="{{ route('register') }}"
                            class="flex-1 py-2 rounded-md font-medium text-center tab-active">Pengguna</a>
                        <a href="{{ route('register.doctor') }}"
                            class="flex-1 py-2 rounded-md font-medium text-center">Dokter/Ahli Gizi</a>
                    </div>

                    <!-- Menampilkan pesan error -->
                    @if ($errors->any())
                        <div class="error-message">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Menampilkan pesan sukses -->
                    @if (session('success'))
                        <div class="success-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- User Registration Form -->
                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <!-- Hidden role field dengan value 'user' -->
                        <input type="hidden" name="role" value="user">

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-gray-700 mb-2">Nama Depan</label>
                                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('first_name') border-red-500 @enderror"
                                    placeholder="Nama depan" required>
                                @error('first_name')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-gray-700 mb-2">Nama Belakang</label>
                                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('last_name') border-red-500 @enderror"
                                    placeholder="Nama belakang" required>
                                @error('last_name')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('email') border-red-500 @enderror"
                                placeholder="nama@email.com" required>
                            @error('email')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('phone') border-red-500 @enderror"
                                placeholder="08xxxxxxxxxx" required>
                            @error('phone')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-gray-700 mb-2">Kata Sandi</label>
                            <input type="password" id="password" name="password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('password') border-red-500 @enderror"
                                placeholder="Minimal 8 karakter" required minlength="8">
                            @error('password')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-gray-700 mb-2">Konfirmasi Kata
                                Sandi</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="Ulangi kata sandi" required minlength="8">
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="terms" name="terms"
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
                            sebagai Pengguna</button>
                    </form>

                    <div class="text-center mt-6">
                        <p class="text-gray-600">Sudah punya akun?
                            <a href="{{ route('login') }}"
                                class="text-primary font-medium hover:text-secondary">Masuk di
                                sini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Menangani form submission dengan feedback yang lebih baik
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const terms = document.getElementById('terms').checked;

            if (!terms) {
                e.preventDefault();
                alert('Anda harus menyetujui Syarat & Ketentuan dan Kebijakan Privasi!');
                return;
            }

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Konfirmasi kata sandi tidak sesuai!');
                return;
            }

            if (password.length < 8) {
                e.preventDefault();
                alert('Kata sandi harus minimal 8 karakter!');
                return;
            }

            // Menampilkan loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
            submitBtn.disabled = true;

            // Reset button setelah 5 detik (fallback)
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 5000);
        });

        // Menghilangkan pesan error setelah beberapa detik
        document.addEventListener('DOMContentLoaded', function() {
            const errorMessages = document.querySelectorAll('.error-message, .success-message');
            errorMessages.forEach(function(message) {
                setTimeout(function() {
                    message.style.transition = 'opacity 0.5s ease';
                    message.style.opacity = '0';
                    setTimeout(function() {
                        if (message.parentNode) {
                            message.remove();
                        }
                    }, 500);
                }, 5000);
            });
        });
    </script>
</body>

</html>
