<!-- components/konsultasi-dokter.blade.php -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<section id="konsul_dokter" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Konsultasi dengan Ahli Gizi</h2>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto mt-4">
                Dapatkan pandangan profesional untuk program kesehatan Anda
            </p>
        </div>

        <div class="max-w-6xl mx-auto">
            <!-- Status Berlangganan -->
            <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-8 text-white text-center mb-8">
                <div class="flex items-center justify-center mb-4">
                    <i class="fas fa-user-md text-3xl mr-4"></i>
                    <div class="text-left">
                        <h3 class="text-xl font-bold">Konsultasi Dokter & Ahli Gizi</h3>
                        <p class="text-green-100">Fitur Premium</p>
                    </div>
                </div>

                <div id="subscription-status" class="bg-white bg-opacity-20 rounded-lg p-4 inline-block">
                    <div class="flex items-center justify-center space-x-2">
                        <i class="fas fa-crown text-yellow-300"></i>
                        <span class="font-semibold">Status: <span id="status-text">Belum Berlangganan</span></span>
                    </div>
                </div>
            </div>

            <!-- Fitur Konsultasi -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                <!-- Card Konsultasi Online -->
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                    <div class="flex items-start mb-4">
                        <div
                            class="w-12 h-12 bg-primary bg-opacity-10 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-video text-primary text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-dark mb-2">Konsultasi Online</h3>
                            <p class="text-gray-600">Video call langsung dengan ahli gizi berpengalaman</p>
                        </div>
                    </div>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-primary mr-3"></i>
                            <span>30 menit sesi konsultasi</span>
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-primary mr-3"></i>
                            <span>Analisis kondisi kesehatan</span>
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-primary mr-3"></i>
                            <span>Rekomendasi program personal</span>
                        </li>
                    </ul>
                    <button onclick="showSubscriptionModal()"
                        class="w-full bg-primary text-white py-3 rounded-xl font-bold hover:bg-secondary transition disabled:opacity-50 disabled:cursor-not-allowed"
                        id="consult-button">
                        <i class="fas fa-calendar-check mr-2"></i>
                        Jadwalkan Konsultasi
                    </button>
                </div>

                <!-- Card Chat Dokter -->
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                    <div class="flex items-start mb-4">
                        <div
                            class="w-12 h-12 bg-secondary bg-opacity-10 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-comments text-secondary text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-dark mb-2">Chat Dokter 24/7</h3>
                            <p class="text-gray-600">Tanya jawab cepat dengan tim ahli kami</p>
                        </div>
                    </div>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-secondary mr-3"></i>
                            <span>Respon dalam 1 jam</span>
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-secondary mr-3"></i>
                            <span>Konsultasi teks dan gambar</span>
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-secondary mr-3"></i>
                            <span>Follow-up progress</span>
                        </li>
                    </ul>
                    <button onclick="showSubscriptionModal()"
                        class="w-full bg-secondary text-white py-3 rounded-xl font-bold hover:bg-accent transition disabled:opacity-50 disabled:cursor-not-allowed"
                        id="chat-button">
                        <i class="fas fa-message mr-2"></i>
                        Mulai Chat
                    </button>
                </div>
            </div>

            <!-- Paket Berlangganan -->
            <div id="paket-berlangganan" class="bg-gray-50 rounded-2xl p-8">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-dark mb-2">Pilih Paket Berlangganan</h3>
                    <p class="text-gray-600">Akses semua fitur premium dengan berlangganan</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Paket Bulanan -->
                    <div class="bg-white rounded-xl p-6 border-2 border-gray-200 hover:border-primary transition-all">
                        <div class="text-center mb-6">
                            <h4 class="text-lg font-bold text-dark mb-2">Bulanan</h4>
                            <div class="flex items-baseline justify-center">
                                <span class="text-3xl font-bold text-primary">Rp 99.000</span>
                                <span class="text-gray-500 ml-2">/bulan</span>
                            </div>
                        </div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-primary mr-3"></i>
                                <span class="text-sm">2x konsultasi online</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-primary mr-3"></i>
                                <span class="text-sm">Chat dokter unlimited</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-primary mr-3"></i>
                                <span class="text-sm">Akses artikel premium</span>
                            </li>
                        </ul>
                        <button onclick="selectPackage('bulanan')"
                            class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-secondary transition">
                            Pilih Paket
                        </button>
                    </div>

                    <!-- Paket 3 Bulan -->
                    <div class="bg-white rounded-xl p-6 border-2 border-primary shadow-lg relative">
                        <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                            <span class="bg-primary text-white px-3 py-1 rounded-full text-sm font-bold">
                                POPULER
                            </span>
                        </div>
                        <div class="text-center mb-6">
                            <h4 class="text-lg font-bold text-dark mb-2">3 Bulan</h4>
                            <div class="flex items-baseline justify-center">
                                <span class="text-3xl font-bold text-primary">Rp 249.000</span>
                                <span class="text-gray-500 ml-2">/3 bulan</span>
                            </div>
                            <div class="text-green-600 text-sm font-semibold mt-1">
                                Hemat Rp 48.000
                            </div>
                        </div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-primary mr-3"></i>
                                <span class="text-sm">6x konsultasi online</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-primary mr-3"></i>
                                <span class="text-sm">Chat dokter unlimited</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-primary mr-3"></i>
                                <span class="text-sm">Akses semua fitur premium</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-primary mr-3"></i>
                                <span class="text-sm">Progress tracking</span>
                            </li>
                        </ul>
                        <button onclick="selectPackage('3bulan')"
                            class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-secondary transition">
                            Pilih Paket
                        </button>
                    </div>

                    <!-- Paket Tahunan -->
                    <div class="bg-white rounded-xl p-6 border-2 border-gray-200 hover:border-primary transition-all">
                        <div class="text-center mb-6">
                            <h4 class="text-lg font-bold text-dark mb-2">Tahunan</h4>
                            <div class="flex items-baseline justify-center">
                                <span class="text-3xl font-bold text-primary">Rp 899.000</span>
                                <span class="text-gray-500 ml-2">/tahun</span>
                            </div>
                            <div class="text-green-600 text-sm font-semibold mt-1">
                                Hemat Rp 289.000
                            </div>
                        </div>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-primary mr-3"></i>
                                <span class="text-sm">24x konsultasi online</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-primary mr-3"></i>
                                <span class="text-sm">Chat dokter unlimited</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-primary mr-3"></i>
                                <span class="text-sm">Semua fitur premium</span>
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-primary mr-3"></i>
                                <span class="text-sm">Konsultasi prioritas</span>
                            </li>
                        </ul>
                        <button onclick="selectPackage('tahunan')"
                            class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-secondary transition">
                            Pilih Paket
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Berlangganan -->
<div id="subscription-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-primary bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-crown text-primary text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-dark mb-2">Akses Fitur Premium</h3>
            <p class="text-gray-600">Berlangganan untuk mengakses konsultasi dokter dan ahli gizi</p>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-yellow-500 mr-3"></i>
                <p class="text-yellow-700 text-sm">
                    Anda perlu berlangganan terlebih dahulu untuk menggunakan fitur konsultasi
                </p>
            </div>
        </div>

        <div class="flex space-x-4">
            <button onclick="hideSubscriptionModal()"
                class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                Nanti Saja
            </button>
            <a href="#paket-berlangganan"
                class="flex-1 px-4 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-secondary transition text-center">
                Lihat Paket
            </a>
        </div>
    </div>
</div>

<!-- Modal Sukses -->
<div id="success-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-2xl shadow-lg text-center max-w-sm mx-4">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-check-circle text-green-500 text-3xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-green-600 mb-2">Berhasil Berlangganan!</h2>
        <p class="text-gray-600 mb-6">Langganan kamu telah aktif. Nikmati fitur premium sekarang!</p>
        <button onclick="closeSuccessModal()"
            class="bg-primary text-white px-6 py-2 rounded-lg font-semibold hover:bg-secondary transition">
            Oke
        </button>
    </div>
</div>

<script>
    function showSuccessModal() {
        document.getElementById('success-modal').classList.remove('hidden');
    }

    function closeSuccessModal() {
        document.getElementById('success-modal').classList.add('hidden');
    }
</script>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script>
    // Simulasi status berlangganan user
    let userSubscription = @json(auth()->user()?->subscriptions()->where('status', 'active')->latest()->first());

    function updateSubscriptionStatus() {
        const statusElement = document.getElementById('status-text');
        const consultButton = document.getElementById('consult-button');
        const chatButton = document.getElementById('chat-button');
        const paketSection = document.getElementById('paket-berlangganan');
        const subscriptionModal = document.getElementById('subscription-modal');

        if (userSubscription) {
            statusElement.textContent = `Aktif (${userSubscription.plan_name})`;
            statusElement.className = 'text-green-300';
            consultButton.disabled = false;
            chatButton.disabled = false;

            // 👇 Sembunyikan bagian berlangganan kalau user aktif
            if (paketSection) paketSection.style.display = 'none';
            if (subscriptionModal) subscriptionModal.remove(); // hapus modal agar tak bisa di-trigger
        } else {
            statusElement.textContent = 'Belum Berlangganan';
            statusElement.className = 'text-yellow-300';
            consultButton.disabled = true;
            chatButton.disabled = true;

            // 👇 Pastikan paket muncul kalau belum aktif
            if (paketSection) paketSection.style.display = '';
        }

        if (userSubscription) {
            statusElement.textContent = `Aktif (${userSubscription.plan_name})`;
            statusElement.className = 'text-green-300';
            consultButton.disabled = false;
            chatButton.disabled = false;
        } else {
            statusElement.textContent = 'Belum Berlangganan';
            statusElement.className = 'text-yellow-300';
            consultButton.disabled = true;
            chatButton.disabled = true;
        }
    }

    function showSubscriptionModal() {
        if (!userSubscription) {
            document.getElementById('subscription-modal').classList.remove('hidden');
        }
    }

    function hideSubscriptionModal() {
        document.getElementById('subscription-modal').classList.add('hidden');
    }

    function selectPackage(packageType) {
        fetch("/subscribe", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    package: packageType
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.snapToken) {
                    // Panggil Snap Midtrans
                    window.snap.pay(data.snapToken, {
                        onSuccess: function(result) {
                            // Kirim update ke server agar status langsung aktif
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
                                        userSubscription = {
                                            plan_name: result
                                                .order_id, // simulasi agar status muncul aktif
                                            status: "active"
                                        };
                                        updateSubscriptionStatus();
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

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateSubscriptionStatus();

        // Close modal ketika klik di luar
        document.getElementById('subscription-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideSubscriptionModal();
            }
        });
    });
</script>

<style>
    #consult-button:disabled::after,
    #chat-button:disabled::after {
        content: " (Perlu Berlangganan)";
        font-size: 0.8em;
        opacity: 0.8;
    }

    .package-card:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
    }
</style>
