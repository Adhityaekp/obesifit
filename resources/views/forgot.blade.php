<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBESIFIT - Lupa Kata Sandi</title>
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

        .step-active {
            background-color: #4EAC92;
            color: white;
        }

        .step-completed {
            background-color: #3A8C74;
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
            <a href="/login" class="text-primary hover:text-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Login
            </a>
        </div>
    </header>

    <main class="min-h-screen flex items-center justify-center py-12 px-4">
        {{-- Login Container --}}
        <div id="login-container" class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 auth-bg text-white p-8 md:p-12 flex flex-col justify-center">
                    <h2 class="text-3xl font-bold mb-4">Selamat Datang Kembali!</h2>
                    <p>Masuk ke akun OBESIFIT Anda untuk mengakses semua fitur.</p>
                </div>

                <div class="md:w-1/2 p-8 md:p-12">
                    <h1 class="text-3xl font-bold mb-4">Masuk</h1>

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="email" class="block mb-1">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label for="password" class="block mb-1">Kata Sandi</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-500">
                        </div>
                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="mr-2">
                                Ingat saya
                            </label>
                            <a href="/forgot" class="text-green-700">Lupa kata sandi?</a>
                        </div>
                        <button type="submit"
                            class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Masuk</button>
                    </form>

                    <p class="mt-4 text-center">
                        Belum punya akun?
                        <a href="#" id="show-register" class="text-green-600 font-medium">Daftar di sini</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Register Container --}}
        <div id="register-container" class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden hidden">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 auth-bg text-white p-8 md:p-12 flex flex-col justify-center">
                    <h2 class="text-3xl font-bold mb-4">Bergabung dengan OBESIFIT!</h2>
                    <p>Daftar sekarang untuk mendapatkan akses penuh ke semua fitur edukasi.</p>
                </div>

                <div class="md:w-1/2 p-8 md:p-12">
                    <div class="flex mb-4 bg-gray-100 rounded">
                        <button id="tab-user" class="flex-1 py-2 tab-active">Pengguna</button>
                        <button id="tab-doctor" class="flex-1 py-2">Dokter</button>
                    </div>

                    {{-- User Registration --}}
                    <form id="register-user-form" action="{{ route('register.user') }}" method="POST"
                        class="space-y-3">
                        @csrf
                        <div class="grid grid-cols-2 gap-2">
                            <input type="text" name="first_name" placeholder="Nama Depan" required
                                class="border px-3 py-2 rounded">
                            <input type="text" name="last_name" placeholder="Nama Belakang" required
                                class="border px-3 py-2 rounded">
                        </div>
                        <input type="email" name="email" placeholder="Email" required
                            class="w-full border px-3 py-2 rounded">
                        <input type="text" name="phone" placeholder="Nomor Telepon" required
                            class="w-full border px-3 py-2 rounded">
                        <input type="password" name="password" placeholder="Kata Sandi" required
                            class="w-full border px-3 py-2 rounded">
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required
                            class="w-full border px-3 py-2 rounded">
                        <label class="flex items-center">
                            <input type="checkbox" name="terms" required class="mr-2"> Saya setuju Syarat &
                            Ketentuan
                        </label>
                        <button type="submit"
                            class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Daftar sebagai
                            Pengguna</button>
                    </form>

                    {{-- Doctor Registration --}}
                    <form id="register-doctor-form" action="{{ route('register.doctor') }}" method="POST"
                        class="space-y-3 hidden">
                        @csrf
                        <div class="grid grid-cols-2 gap-2">
                            <input type="text" name="first_name" placeholder="Nama Depan" required
                                class="border px-3 py-2 rounded">
                            <input type="text" name="last_name" placeholder="Nama Belakang" required
                                class="border px-3 py-2 rounded">
                        </div>
                        <input type="email" name="email" placeholder="Email" required
                            class="w-full border px-3 py-2 rounded">
                        <select name="specialization" required class="w-full border px-3 py-2 rounded">
                            <option value="">Pilih Spesialisasi</option>
                            <option value="gizi">Ahli Gizi</option>
                            <option value="dokter-umum">Dokter Umum</option>
                            <option value="dokter-spesialis">Dokter Spesialis</option>
                            <option value="dietisien">Dietisien</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        <input type="text" name="license_number" placeholder="Nomor Lisensi" required
                            class="w-full border px-3 py-2 rounded">
                        <input type="password" name="password" placeholder="Kata Sandi" required
                            class="w-full border px-3 py-2 rounded">
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi"
                            required class="w-full border px-3 py-2 rounded">
                        <label class="flex items-center">
                            <input type="checkbox" name="terms" required class="mr-2"> Saya setuju Syarat &
                            Ketentuan
                        </label>
                        <button type="submit"
                            class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Daftar sebagai
                            Dokter</button>
                    </form>

                    <p class="mt-4 text-center">
                        Sudah punya akun?
                        <a href="#" id="show-login" class="text-green-600 font-medium">Masuk di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Toggle login/register
        document.getElementById('show-register').addEventListener('click', e => {
            e.preventDefault();
            document.getElementById('login-container').classList.add('hidden');
            document.getElementById('register-container').classList.remove('hidden');
        });
        document.getElementById('show-login').addEventListener('click', e => {
            e.preventDefault();
            document.getElementById('register-container').classList.add('hidden');
            document.getElementById('login-container').classList.remove('hidden');
        });

        // Toggle tabs
        document.getElementById('tab-user').addEventListener('click', () => {
            document.getElementById('tab-user').classList.add('tab-active');
            document.getElementById('tab-doctor').classList.remove('tab-active');
            document.getElementById('register-user-form').classList.remove('hidden');
            document.getElementById('register-doctor-form').classList.add('hidden');
        });
        document.getElementById('tab-doctor').addEventListener('click', () => {
            document.getElementById('tab-doctor').classList.add('tab-active');
            document.getElementById('tab-user').classList.remove('tab-active');
            document.getElementById('register-doctor-form').classList.remove('hidden');
            document.getElementById('register-user-form').classList.add('hidden');
        });
    </script>
</body>

</html>
