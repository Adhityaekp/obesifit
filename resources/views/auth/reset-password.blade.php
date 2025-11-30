<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBESIFIT - Reset Kata Sandi</title>
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
            <a href="{{ route('login') }}" class="text-primary hover:text-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Login
            </a>
        </div>
    </header>

    <main class="min-h-screen flex items-center justify-center py-12 px-4">
        <!-- Reset Password Container -->
        <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-dark mb-2">Reset Kata Sandi</h1>
                <p class="text-gray-600">Masukkan kata sandi baru Anda.</p>
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

            @if (session('status'))
                <div class="success-message">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf

                <!-- Token reset password -->
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="block text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('email') border-red-500 @enderror"
                        placeholder="nama@email.com" required autofocus>
                </div>

                <div>
                    <label for="password" class="block text-gray-700 mb-2">Kata Sandi Baru</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('password') border-red-500 @enderror"
                        placeholder="Masukkan kata sandi baru" required>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        placeholder="Konfirmasi kata sandi baru" required>
                </div>

                <button type="submit"
                    class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-secondary transition">
                    Reset Kata Sandi
                </button>

                <div class="text-center">
                    <p class="text-gray-600">Sudah ingat kata sandi Anda?
                        <a href="{{ route('login') }}" class="text-primary font-medium hover:text-secondary">Masuk di sini</a>
                    </p>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const messages = document.querySelectorAll('.error-message, .success-message');
            messages.forEach(function (msg) {
                setTimeout(function () {
                    msg.style.transition = 'opacity 0.5s ease';
                    msg.style.opacity = '0';
                    setTimeout(function () { msg.remove(); }, 500);
                }, 5000);
            });
        });
    </script>
</body>

</html>
