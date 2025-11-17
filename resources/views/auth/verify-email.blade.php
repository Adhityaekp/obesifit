<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBESIFIT - Verifikasi Email</title>
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
        <!-- Verification Container -->
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Left Side - Illustration -->
                <div class="md:w-1/2 auth-bg text-white p-8 md:p-12 flex flex-col justify-center">
                    <div class="text-center md:text-left">
                        <h2 class="text-3xl font-bold mb-4">Verifikasi Email Anda!</h2>
                        <p class="text-green-100 mb-6">Langkah penting untuk mengaktifkan akun OBESIFIT Anda dan
                            mengakses semua fitur edukasi obesitas yang tersedia.</p>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-shield-check text-white"></i>
                                </div>
                                <span>Amankan akun Anda dengan verifikasi</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-lock-open text-white"></i>
                                </div>
                                <span>Akses penuh ke semua fitur OBESIFIT</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-bell text-white"></i>
                                </div>
                                <span>Dapatkan notifikasi terbaru</span>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-comments text-white"></i>
                                </div>
                                <span>Ikuti forum diskusi dengan aman</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Verification Form -->
                <div class="md:w-1/2 p-8 md:p-12">
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-dark mb-2">Verifikasi Email</h1>
                        <p class="text-gray-600">Langkah terakhir untuk mengaktifkan akun Anda</p>
                    </div>

                    <!-- Menampilkan pesan sukses -->
                    @if (session('success'))
                        <div class="success-message">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-6">
                        <div class="text-center">
                            <div
                                class="w-20 h-20 bg-primary bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-envelope text-primary text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-dark mb-2">Periksa Email Anda</h3>
                            <p class="text-gray-600 mb-4">Terima kasih telah mendaftar! Sebelum memulai, silakan
                                verifikasi email Anda dengan mengklik link yang kami kirim ke email Anda.</p>
                            <p class="text-gray-600">Jika Anda tidak menerima email, klik tombol di bawah untuk mengirim
                                ulang.</p>
                        </div>

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit"
                                class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-secondary transition flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-2"></i>Kirim Ulang Email Verifikasi
                            </button>
                        </form>

                        <div class="text-center">
                            <p class="text-gray-600">Sudah verifikasi email?
                                <a href="{{ route('login') }}"
                                    class="text-primary font-medium hover:text-secondary">Masuk di sini</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Menghilangkan pesan sukses setelah beberapa detik
        document.addEventListener('DOMContentLoaded', function() {
            const successMessages = document.querySelectorAll('.success-message');
            successMessages.forEach(function(message) {
                setTimeout(function() {
                    message.style.transition = 'opacity 0.5s ease';
                    message.style.opacity = '0';
                    setTimeout(function() {
                        message.remove();
                    }, 500);
                }, 5000);
            });

            // Menangani form submission dengan feedback yang lebih baik
            document.querySelector('form').addEventListener('submit', function(e) {
                // Menampilkan loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';
                submitBtn.disabled = true;

                // Kembalikan teks asli setelah 3 detik (jika halaman tidak di-refresh)
                setTimeout(function() {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            });
        });
    </script>
</body>

</html>
