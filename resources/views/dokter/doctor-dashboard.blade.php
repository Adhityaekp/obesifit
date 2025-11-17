<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konsultasi Dokter - OBESIFIT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        body {
            overflow-x: hidden;
        }

        .chat-container {
            height: calc(100vh - 280px);
            min-height: 400px;
        }

        .messages-container {
            height: calc(100% - 220px);
            overflow-y: auto;
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        .messages-container::-webkit-scrollbar,
        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .messages-container::-webkit-scrollbar-track,
        .sidebar-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .messages-container::-webkit-scrollbar-thumb {
            background: #4EAC92;
            border-radius: 10px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #D1D5DB;
            border-radius: 10px;
        }

        .messages-container::-webkit-scrollbar-thumb:hover {
            background: #3A8C74;
        }

        /* Message Bubbles */
        .message-doctor {
            background: linear-gradient(135deg, #4EAC92, #3A8C74);
            color: white;
            border-radius: 18px 18px 4px 18px;
            box-shadow: 0 2px 8px rgba(78, 172, 146, 0.2);
        }

        .message-patient {
            background: #F3F4F6;
            color: #1F2937;
            border-radius: 18px 18px 18px 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        /* Online Status */
        .online-dot {
            width: 10px;
            height: 10px;
            background: #10B981;
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        /* Card Hover Effects */
        .consultation-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .consultation-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(78, 172, 146, 0.15);
        }

        .patient-card {
            transition: all 0.3s ease;
        }

        .patient-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 172, 146, 0.12);
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-pending {
            background: #FEF3C7;
            color: #92400E;
        }

        .status-approved {
            background: #D1FAE5;
            color: #065F46;
        }

        .status-complete {
            background: #E0E7FF;
            color: #3730A3;
        }

        /* Modal Animations */
        .modal-overlay {
            backdrop-filter: blur(4px);
            animation: fadeIn 0.2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal-content {
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #4EAC92, #3A8C74);
            transition: all 0.3s ease;
        }

        .btn-primary:hover:not(:disabled) {
            background: linear-gradient(135deg, #3A8C74, #2C6B58);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 172, 146, 0.3);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-danger {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            transition: all 0.3s ease;
        }

        .btn-danger:hover:not(:disabled) {
            background: linear-gradient(135deg, #DC2626, #B91C1C);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* Empty State Animation */
        .empty-state {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Sidebar Scroll */
        .sidebar-scroll {
            max-height: 350px;
            overflow-y: auto;
        }

        /* Section Headers */
        .section-header {
            position: sticky;
            top: 0;
            background: linear-gradient(to bottom, #F9FAFB 90%, transparent);
            z-index: 10;
            padding: 8px 0;
        }

        /* Badge Counter */
        .badge-counter {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            background: #EF4444;
            color: white;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .chat-container {
                height: calc(100vh - 220px);
            }

            .sidebar-scroll {
                max-height: 250px;
            }
        }

        @media (max-width: 768px) {
            .chat-container {
                height: calc(100vh - 200px);
            }

            .sidebar-scroll {
                max-height: 200px;
            }
        }

        /* Focus States */
        input:focus,
        textarea:focus {
            outline: none;
            border-color: #4EAC92;
            box-shadow: 0 0 0 3px rgba(78, 172, 146, 0.1);
        }

        /* Patient Avatar */
        .patient-avatar {
            transition: transform 0.3s ease;
        }

        .consultation-card:hover .patient-avatar,
        .patient-card:hover .patient-avatar {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="font-poppins bg-light">
    @auth
        @include('components.navbar-user')
    @endauth

    <!-- Hero Section - Enhanced -->
    <section
        class="bg-gradient-to-br from-primary via-secondary to-accent text-white pt-24 pb-12 md:pt-28 md:pb-16 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="inline-block mb-4">
                <div
                    class="w-16 h-16 md:w-20 md:h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto backdrop-blur-sm">
                    <i class="fas fa-user-md text-3xl md:text-4xl"></i>
                </div>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight">Konsultasi Pasien</h1>
            <p class="text-base md:text-xl text-green-100 max-w-2xl mx-auto leading-relaxed">
                Kelola request konsultasi pasien.<br class="hidden md:block">
                Approve atau tolak request dan mulai chat dengan pasien Anda.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="py-6 md:py-8 container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 md:gap-6">
            <!-- Sidebar - Enhanced -->
            <div class="lg:col-span-1 space-y-4">
                <!-- Pending Requests -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-yellow-500 to-orange-500 p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-clock text-xl"></i>
                                <h3 class="font-bold text-base">Request Pending</h3>
                            </div>
                            <span class="badge-counter" id="pending-count">0</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="sidebar-scroll space-y-3" id="patients-list">
                            <div class="text-center py-8">
                                <i class="fas fa-inbox text-3xl text-gray-300 mb-2"></i>
                                <p class="text-sm text-gray-500">Tidak ada request</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Chats -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-primary to-secondary p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-comments text-xl"></i>
                                <h3 class="font-bold text-base">Chat Aktif</h3>
                            </div>
                            <span class="badge-counter bg-white text-primary" id="active-count">0</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="sidebar-scroll space-y-3" id="approved-patients-list">
                            <div class="text-center py-8">
                                <i class="fas fa-comment-slash text-3xl text-gray-300 mb-2"></i>
                                <p class="text-sm text-gray-500">Belum ada chat aktif</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- History -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-600 to-gray-700 p-4 text-white">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-history text-xl"></i>
                            <h3 class="font-bold text-base">Riwayat Selesai</h3>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="sidebar-scroll space-y-3" id="history-patients-list">
                            <div class="text-center py-8">
                                <i class="fas fa-clipboard-check text-3xl text-gray-300 mb-2"></i>
                                <p class="text-sm text-gray-500">Belum ada riwayat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Area - Enhanced -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <!-- Chat Header -->
                    <div class="border-b border-gray-200 p-4 md:p-5 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <img src="/img/default-user.jpg" alt="Pasien"
                                        class="w-12 h-12 md:w-14 md:h-14 rounded-full object-cover ring-2 ring-primary ring-offset-2"
                                        id="current-patient-avatar">
                                    <div class="online-dot absolute bottom-0 right-0 border-2 border-white hidden"
                                        id="current-patient-status"></div>
                                </div>
                                <div>
                                    <div class="font-semibold text-dark text-base md:text-lg" id="current-patient-name">
                                        Pilih pasien untuk chat
                                    </div>
                                    <div class="text-sm text-gray-600" id="current-patient-info">
                                        Approve request dulu untuk mulai chat
                                    </div>
                                </div>
                            </div>
                            <button class="hidden md:block text-gray-400 hover:text-primary transition">
                                <i class="fas fa-ellipsis-v text-xl"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Messages Container -->
                    <div class="chat-container">
                        <div class="messages-container p-4 md:p-6 bg-gradient-to-b from-gray-50 to-white"
                            id="messages-container">
                            <!-- Welcome State -->
                            <div class="text-center mb-6 empty-state">
                                <div
                                    class="inline-block bg-white rounded-3xl px-6 md:px-8 py-6 md:py-8 shadow-lg max-w-md border border-gray-100">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-user-md text-3xl text-white"></i>
                                    </div>
                                    <h4 class="font-semibold text-dark mb-2 text-lg">Selamat Datang Dokter</h4>
                                    <p class="text-sm text-gray-600 leading-relaxed">
                                        Pilih pasien yang sudah disetujui<br>untuk memulai chat konsultasi.
                                    </p>
                                </div>
                            </div>
                            <div id="chat-messages"></div>
                        </div>

                        <!-- Suggested Messages - Improved -->
                        <div class="p-3 md:p-4 border-t border-gray-100 bg-gray-50" id="suggested-container">
                            <div class="flex flex-wrap gap-2" id="suggested-messages">
                                <!-- Suggestions will be rendered here -->
                            </div>
                        </div>

                        <!-- Input Area -->
                        <div class="border-t border-gray-200 p-3 md:p-4 bg-white">
                            <div class="flex items-center space-x-2 md:space-x-3">
                                <button
                                    class="w-10 h-10 flex-shrink-0 flex items-center justify-center text-gray-400 hover:text-primary transition rounded-full hover:bg-gray-100">
                                    <i class="fas fa-paperclip text-lg"></i>
                                </button>
                                <div class="flex-1">
                                    <input type="text" placeholder="Ketik pesan untuk pasien..."
                                        id="message-input"
                                        class="w-full px-4 md:px-5 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-sm md:text-base"
                                        disabled>
                                </div>
                                <button id="send-button"
                                    class="w-12 h-12 flex-shrink-0 btn-primary rounded-full flex items-center justify-center text-white disabled:opacity-50"
                                    disabled>
                                    <i class="fas fa-paper-plane text-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal - Enhanced -->
    <div id="consultation-modal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 modal-overlay flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl w-full max-w-md modal-content shadow-2xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-times-circle text-red-500"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark">Tolak Konsultasi</h3>
                    </div>
                    <button id="close-reject-modal"
                        class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <p class="text-sm text-gray-600 mb-4">Berikan alasan penolakan kepada pasien</p>
                <textarea id="consultation-reason"
                    class="w-full border border-gray-300 rounded-xl p-4 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500 transition resize-none text-sm"
                    rows="4" placeholder="Tulis alasan penolakan..."></textarea>
                <div class="flex flex-col sm:flex-row justify-end gap-2">
                    <button id="cancel-consultation"
                        class="px-6 py-3 bg-gray-200 hover:bg-gray-300 rounded-xl transition font-medium text-sm">
                        Batal
                    </button>
                    <button id="submit-consultation"
                        class="px-6 py-3 btn-danger text-white rounded-xl font-medium text-sm">
                        Tolak Request
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-400">&copy; 2025 OBESIFIT. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // ====== CONFIG (TIDAK DIUBAH) ======
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;
        const CURRENT_DOCTOR_ID = {{ auth()->id() ?? 'null' }};
        let currentConsultationId = null;

        // ====== HELPERS (TIDAK DIUBAH) ======
        function escapeHtml(unsafe) {
            return String(unsafe).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }

        function scrollChatToBottom() {
            const container = document.querySelector('.messages-container');
            if (container) {
                setTimeout(() => {
                    container.scrollTop = container.scrollHeight;
                }, 100);
            }
        }

        function getTime() {
            const now = new Date();
            return now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
        }

        // ====== FETCH LISTS (TIDAK DIUBAH) ======
        async function fetchPatients() {
            try {
                const resPending = await fetch('/consultations/doctor', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const pendingData = resPending.ok ? await resPending.json() : [];

                const resApproved = await fetch('/consultations/doctor/approved', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const approvedData = resApproved.ok ? await resApproved.json() : [];

                const resHistory = await fetch('/consultations/doctor/history', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const historyData = resHistory.ok ? await resHistory.json() : [];

                renderPatients(pendingData || []);
                renderApprovedPatients(approvedData || []);
                renderHistoryPatients(historyData || []);

            } catch (err) {
                console.error('Gagal memuat pasien:', err);
            }
        }

        // ====== RENDER PENDING (STYLE UPDATE) ======
        function renderPatients(patients) {
            const container = document.getElementById('patients-list');
            const countEl = document.getElementById('pending-count');
            container.innerHTML = '';
            countEl.textContent = patients.length;

            if (patients.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-inbox text-3xl text-gray-300 mb-2"></i>
                        <p class="text-sm text-gray-500">Tidak ada request</p>
                    </div>
                `;
                return;
            }

            patients.forEach(p => {
                const card = document.createElement('div');
                card.className = 'patient-card p-4 bg-white rounded-xl shadow-sm border border-gray-100';
                card.dataset.id = p.id;
                card.innerHTML = `
                    <div class="flex items-start space-x-3 mb-3">
                        <img src="${p.patient_avatar || '/img/default-user.jpg'}" 
                             alt="${escapeHtml(p.patient_name)}"
                             class="patient-avatar w-12 h-12 rounded-full object-cover ring-2 ring-yellow-100">
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-dark truncate">${escapeHtml(p.patient_name)}</div>
                            <div class="text-xs text-gray-500">Request: ${escapeHtml(p.request_date)}</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <span class="status-badge status-pending">
                            <i class="fas fa-clock mr-1 text-xs"></i>Menunggu
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <button class="approve-btn flex-1 btn-primary text-white text-sm rounded-xl py-2 font-medium">
                            <i class="fas fa-check mr-1"></i>Approve
                        </button>
                        <button class="reject-btn flex-1 bg-gray-300 hover:bg-gray-400 text-dark text-sm rounded-xl py-2 transition font-medium">
                            <i class="fas fa-times mr-1"></i>Tolak
                        </button>
                    </div>
                `;

                const approveBtn = card.querySelector('.approve-btn');
                const rejectBtn = card.querySelector('.reject-btn');

                approveBtn.addEventListener('click', async () => {
                    if (!confirm('Setujui konsultasi ini?')) return;
                    try {
                        approveBtn.disabled = true;
                        approveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Proses...';
                        const res = await fetch(`/consultations/${p.id}/approve`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': CSRF_TOKEN,
                                'Accept': 'application/json'
                            }
                        });
                        if (!res.ok) throw new Error('Gagal approve');
                        await fetchPatients();
                    } catch (err) {
                        console.error(err);
                        approveBtn.disabled = false;
                        approveBtn.innerHTML = '<i class="fas fa-check mr-1"></i>Approve';
                    }
                });

                rejectBtn.addEventListener('click', () => {
                    openRejectModal(p, card);
                });

                container.appendChild(card);
            });
        }

        // ====== RENDER APPROVED (STYLE UPDATE) ======
        function renderApprovedPatients(patients) {
            const container = document.getElementById('approved-patients-list');
            const countEl = document.getElementById('active-count');
            container.innerHTML = '';
            countEl.textContent = patients.length;

            if (patients.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-comment-slash text-3xl text-gray-300 mb-2"></i>
                        <p class="text-sm text-gray-500">Belum ada chat aktif</p>
                    </div>
                `;
                return;
            }

            patients.forEach(p => {
                const card = document.createElement('div');
                card.className =
                    'consultation-card p-4 bg-white rounded-xl shadow-sm border border-gray-100 hover:border-primary';
                card.dataset.id = p.id;

                card.innerHTML = `
                    <div class="flex items-start space-x-3 mb-3">
                        <img src="${p.patient_avatar || '/img/default-user.jpg'}" 
                             alt="${escapeHtml(p.patient_name)}"
                             class="patient-avatar w-12 h-12 rounded-full object-cover ring-2 ring-green-100">
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-dark truncate">${escapeHtml(p.patient_name)}</div>
                            <div class="text-xs text-gray-500">${p.approved_at ? 'Diterima ' + escapeHtml(p.approved_at) : ''}</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <span class="status-badge status-approved">
                            <i class="fas fa-check-circle mr-1 text-xs"></i>Aktif
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <button class="open-chat-btn flex-1 btn-primary text-white text-sm rounded-xl py-2 font-medium">
                            <i class="fas fa-comments mr-1"></i>Buka Chat
                        </button>
                        <button class="complete-btn flex-1 btn-danger text-white text-sm rounded-xl py-2 font-medium">
                            <i class="fas fa-check-double mr-1"></i>Selesai
                        </button>
                    </div>
                `;

                card.querySelector(".open-chat-btn").addEventListener("click", async () => {
                    selectApprovedPatient(p);
                    currentConsultationId = p.id;
                    await loadChatMessages(p.id);
                });

                card.querySelector(".complete-btn").addEventListener("click", async () => {
                    if (!confirm("Selesaikan konsultasi ini?")) return;

                    try {
                        const res = await fetch(`/consultations/${p.id}/complete`, {
                            method: "POST",
                            headers: {
                                "Accept": "application/json",
                                "X-CSRF-TOKEN": CSRF_TOKEN,
                            }
                        });

                        if (!res.ok) throw new Error("Gagal menyelesaikan konsultasi");

                        await fetchPatients();
                        alert("Konsultasi selesai");
                    } catch (err) {
                        console.error(err);
                        alert("Terjadi kesalahan");
                    }
                });

                container.appendChild(card);
            });
        }

        // ====== SELECT APPROVED PATIENT (TIDAK DIUBAH) ======
        function selectApprovedPatient(patient) {
            document.getElementById('current-patient-avatar').src = patient.patient_avatar ?? '/img/default-user.jpg';
            document.getElementById('current-patient-name').textContent = patient.patient_name;
            document.getElementById('current-patient-info').textContent = 'Sedang chat dengan pasien';
            document.getElementById('message-input').disabled = false;
            document.getElementById('send-button').disabled = false;
            document.getElementById('chat-messages').innerHTML = '';
        }

        // ====== RENDER HISTORY (STYLE UPDATE) ======
        function renderHistoryPatients(patients) {
            const container = document.getElementById('history-patients-list');
            container.innerHTML = '';

            if (patients.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-clipboard-check text-3xl text-gray-300 mb-2"></i>
                        <p class="text-sm text-gray-500">Belum ada riwayat</p>
                    </div>
                `;
                return;
            }

            patients.forEach(p => {
                const card = document.createElement('div');
                card.className =
                    'consultation-card p-4 bg-gray-50 rounded-xl shadow-sm border border-gray-200 hover:bg-gray-100';
                card.dataset.id = p.id;

                card.innerHTML = `
                    <div class="flex items-start space-x-3 mb-2">
                        <img src="${p.patient_avatar || '/img/default-user.jpg'}" 
                             alt="${escapeHtml(p.patient_name)}"
                             class="patient-avatar w-10 h-10 rounded-full object-cover ring-2 ring-gray-200">
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-dark text-sm truncate">${escapeHtml(p.patient_name)}</div>
                            <div class="text-xs text-gray-500">Selesai: ${escapeHtml(p.completed_at || '')}</div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="status-badge status-complete">
                            <i class="fas fa-check-double mr-1 text-xs"></i>Selesai
                        </span>
                    </div>
                `;

                card.addEventListener('click', async () => {
                    await openHistoryChat(p);
                });

                container.appendChild(card);
            });
        }

        // ====== OPEN HISTORY CHAT (TIDAK DIUBAH) ======
        async function openHistoryChat(patient) {
            currentConsultationId = patient.id;
            document.getElementById('current-patient-avatar').src = patient.patient_avatar ?? '/img/default-user.jpg';
            document.getElementById('current-patient-name').textContent = patient.patient_name;
            document.getElementById('current-patient-info').textContent =
                'Riwayat konsultasi (Tidak bisa mengirim pesan)';

            document.getElementById('message-input').disabled = true;
            document.getElementById('send-button').disabled = true;

            await loadChatMessages(patient.id);
        }

        // ====== LOAD CHAT MESSAGES (TIDAK DIUBAH) ======
        async function loadChatMessages(consultationId) {
            try {
                const res = await fetch(`/consultations/${consultationId}/chats`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('Gagal load chat');
                const chats = await res.json();

                const container = document.getElementById('chat-messages');
                container.innerHTML = '';

                chats.forEach(chat => {
                    const isDoctor = Number(chat.sender_id) === Number(CURRENT_DOCTOR_ID);
                    const wrapper = document.createElement('div');
                    wrapper.className = `flex mb-4 ${isDoctor ? 'justify-end' : 'justify-start'}`;

                    const bubbleClass = isDoctor ? 'message-doctor' : 'message-patient';
                    const time = new Date(chat.created_at).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    wrapper.innerHTML = `
                        <div class="max-w-xs md:max-w-md lg:max-w-lg">
                            <div class="${bubbleClass} px-4 py-3">
                                <p class="text-sm md:text-base leading-relaxed">${escapeHtml(chat.message || '[Attachment]')}</p>
                            </div>
                            <div class="text-xs text-gray-500 mt-1 px-1 ${isDoctor ? 'text-right' : 'text-left'}">${escapeHtml(time)}</div>
                        </div>
                    `;
                    container.appendChild(wrapper);
                });

                scrollChatToBottom();
            } catch (err) {
                console.error('Gagal mengambil chat:', err);
            }
        }

        // ====== SEND MESSAGE (TIDAK DIUBAH) ======
        async function sendMessage() {
            const input = document.getElementById('message-input');
            const text = input.value.trim();
            if (!text) return;
            if (!currentConsultationId) {
                alert('Pilih pasien yang sudah di-approve terlebih dahulu.');
                return;
            }

            document.getElementById('send-button').disabled = true;

            try {
                const res = await fetch('/chats', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        consultation_id: currentConsultationId,
                        message: text,
                        type: 'text'
                    })
                });

                if (!res.ok) {
                    const err = await res.json().catch(() => ({
                        message: 'Gagal mengirim pesan'
                    }));
                    throw new Error(err.message || 'Gagal mengirim pesan');
                }

                input.value = '';
                await loadChatMessages(currentConsultationId);

            } catch (err) {
                console.error(err);
                alert(err.message || 'Gagal mengirim pesan');
            } finally {
                document.getElementById('send-button').disabled = false;
            }
        }

        // ====== REJECT FLOW (TIDAK DIUBAH) ======
        const modal = document.getElementById('consultation-modal');
        const textarea = document.getElementById('consultation-reason');
        const cancelBtn = document.getElementById('cancel-consultation');
        const submitBtn = document.getElementById('submit-consultation');
        const closeBtn = document.getElementById('close-reject-modal');
        let rejectPatient = null;
        let rejectCard = null;

        function openRejectModal(patient, card) {
            rejectPatient = patient;
            rejectCard = card;
            textarea.value = '';
            modal.classList.remove('hidden');
        }

        cancelBtn.addEventListener('click', () => modal.classList.add('hidden'));
        closeBtn.addEventListener('click', () => modal.classList.add('hidden'));

        submitBtn.addEventListener('click', async () => {
            if (!textarea.value.trim()) {
                alert('Isi alasan penolakan!');
                return;
            }
            try {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Menolak...';
                const res = await fetch(`/consultations/${rejectPatient.id}/reject`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        doctor_note: textarea.value.trim()
                    })
                });

                if (!res.ok) throw new Error('Gagal menolak');
                await fetchPatients();
                modal.classList.add('hidden');
            } catch (err) {
                console.error(err);
                alert(err.message || 'Gagal menolak');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Tolak Request';
            }
        });

        // ====== EVENT BINDINGS (TIDAK DIUBAH) ======
        document.getElementById('send-button').addEventListener('click', sendMessage);
        document.getElementById('message-input').addEventListener('keypress', e => {
            if (e.key === 'Enter') sendMessage();
        });

        // ====== REFRESH (TIDAK DIUBAH) ======
        let lastLoadedCount = 0;

        setInterval(() => {
            if (!currentConsultationId) return;

            fetch(`/consultations/${currentConsultationId}/chats`)
                .then(res => res.json())
                .then(data => {
                    if (data.length !== lastLoadedCount) {
                        loadChatMessages(currentConsultationId);
                        lastLoadedCount = data.length;
                    }
                })
                .catch(err => console.error(err));
        }, 2000);

        const suggestedMessages = [
            "Silakan lanjutkan diet sesuai rencana",
            "Perlu evaluasi lebih lanjut pada pencernaan Anda",
            "Berat badan Anda sudah menunjukkan perkembangan positif",
            "Disarankan olahraga ringan 30 menit setiap hari",
            "Mohon catat gejala yang muncul dalam 1 minggu ke depan"
        ];

        function renderSuggestedMessages() {
            const container = document.getElementById('suggested-messages');
            container.innerHTML = '';
            suggestedMessages.forEach(msg => {
                const btn = document.createElement('button');
                btn.className =
                    'px-3 py-1 bg-primary text-white text-sm rounded-full hover:bg-secondary transition';
                btn.textContent = msg;
                btn.addEventListener('click', () => {
                    const input = document.getElementById('message-input');
                    input.value = msg;
                    input.focus();
                });
                container.appendChild(btn);
            });
        }

        // Jalankan setelah halaman siap
        renderSuggestedMessages();

        // ====== INIT (TIDAK DIUBAH) ======
        fetchPatients();
    </script>
</body>

</html>
