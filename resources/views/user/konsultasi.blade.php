<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi - OBESIFIT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
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
            font-family: 'Poppins', sans-serif;
        }

        .chat-container {
            height: calc(100vh - 280px);
            min-height: 400px;
            display: flex;
            flex-direction: column;
        }

        .messages-container {
            flex: 1;
            overflow-y: auto;
            scroll-behavior: smooth;
            padding: 1rem;
        }

        /* Custom Scrollbar */
        .messages-container::-webkit-scrollbar {
            width: 6px;
        }

        .messages-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .messages-container::-webkit-scrollbar-thumb {
            background: #4EAC92;
            border-radius: 10px;
        }

        .messages-container::-webkit-scrollbar-thumb:hover {
            background: #3A8C74;
        }

        /* Sidebar Scroll */
        .sidebar-scroll {
            max-height: calc(100vh - 250px);
            overflow-y: auto;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #D1D5DB;
            border-radius: 10px;
        }

        /* Message Bubbles */
        .message-user {
            background: linear-gradient(135deg, #4EAC92, #3A8C74);
            color: white;
            border-radius: 18px 18px 4px 18px;
            box-shadow: 0 2px 8px rgba(78, 172, 146, 0.2);
        }

        .message-expert {
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
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(78, 172, 146, 0.15);
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

        .status-online {
            background: #D1FAE5;
            color: #065F46;
        }

        .status-offline {
            background: #F3F4F6;
            color: #6B7280;
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

        /* Typing Indicator */
        .typing-indicator {
            display: flex;
            gap: 4px;
        }

        .typing-dot {
            width: 8px;
            height: 8px;
            background: #9CA3AF;
            border-radius: 50%;
            animation: typing 1.4s infinite;
        }

        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {

            0%,
            60%,
            100% {
                transform: translateY(0);
            }

            30% {
                transform: translateY(-10px);
            }
        }

        /* Suggested Messages */
        .suggested-btn {
            transition: all 0.2s ease;
        }

        .suggested-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 8px rgba(78, 172, 146, 0.3);
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

        /* Focus States */
        input:focus,
        textarea:focus {
            outline: none;
            border-color: #4EAC92;
            box-shadow: 0 0 0 3px rgba(78, 172, 146, 0.1);
        }

        /* Card Grid Improvements */
        .doctor-avatar {
            transition: transform 0.3s ease;
        }

        .consultation-card:hover .doctor-avatar {
            transform: scale(1.05);
        }

        /* Preview Styles */
        .preview-container {
            transition: all 0.3s ease;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .image-preview img {
            transition: transform 0.3s ease;
            max-width: 100%;
            height: auto;
        }

        .image-preview img:hover {
            transform: scale(1.02);
        }

        /* Chat Input Container */
        .chat-input-wrapper {
            position: sticky;
            bottom: 0;
            background: white;
            border-top: 1px solid #e5e7eb;
            padding: 1rem;
            margin-top: auto;
        }

        /* File attachment styles */
        .file-attachment {
            border-left: 4px solid #4EAC92;
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .chat-container {
                height: calc(100vh - 240px);
            }

            .sidebar-scroll {
                max-height: 300px;
            }
        }

        @media (max-width: 768px) {
            .chat-container {
                height: calc(100vh - 220px);
            }

            .messages-container {
                padding: 0.75rem;
            }

            .sidebar-scroll {
                max-height: 250px;
            }

            .chat-input-wrapper {
                padding: 0.75rem;
            }
        }

        @media (max-width: 640px) {
            .chat-container {
                height: calc(100vh - 200px);
            }

            .messages-container {
                padding: 0.5rem;
            }
        }

        /* Ensure proper box sizing */
        * {
            box-sizing: border-box;
        }

        /* Prevent overflow issues */
        .container {
            max-width: 100%;
        }

        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="font-poppins bg-light">
    <!-- Navbar -->
    @auth
        @include('components.navbar-user')
    @endauth

    <!-- Hero Section - Improved -->
    <section
        class="bg-gradient-to-br from-primary via-secondary to-accent text-white pt-24 pb-12 md:pt-28 md:pb-16 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="inline-block mb-4">
                <div
                    class="w-16 h-16 md:w-20 md:h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto backdrop-blur-sm">
                    <i class="fas fa-comments text-3xl md:text-4xl"></i>
                </div>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight">Konsultasi dengan Ahli</h1>
            <p class="text-base md:text-xl text-green-100 max-w-2xl mx-auto leading-relaxed">
                Dapatkan konsultasi kesehatan dari dokter profesional.<br class="hidden md:block">
                Request konsultasi dan mulai chat setelah disetujui.
            </p>
        </div>
    </section>

    <!-- Main Content - Improved Layout -->
    <div class="py-6 md:py-8 container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 md:gap-6">
            <!-- Sidebar - Enhanced Design -->
            <div class="lg:col-span-1 space-y-4">
                <!-- Daftar Dokter Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-primary to-secondary p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-user-md text-xl"></i>
                                <h3 class="font-bold text-lg">Dokter Tersedia</h3>
                            </div>
                            <span class="bg-white text-primary px-2.5 py-1 rounded-full text-xs font-semibold"
                                id="doctor-count">0</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="sidebar-scroll space-y-3" id="doctors-list">
                            <!-- Doctors will be rendered here -->
                        </div>
                    </div>
                </div>

                <!-- Riwayat Konsultasi Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-600 to-gray-700 p-4 text-white">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-history text-xl"></i>
                            <h3 class="font-bold text-lg">Riwayat Selesai</h3>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="sidebar-scroll space-y-3" id="history-list">
                            <p class="text-sm text-gray-500 text-center py-4">Memuat riwayat...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Area - Enhanced Design -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <!-- Chat Header - Improved -->
                    <div class="border-b border-gray-200 p-4 md:p-5 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <img src="/img/default-user.jpg" alt="Expert"
                                        class="w-12 h-12 md:w-14 md:h-14 rounded-full object-cover ring-2 ring-primary ring-offset-2"
                                        id="current-expert-avatar">
                                    <div class="online-dot absolute bottom-0 right-0 border-2 border-white hidden"
                                        id="current-expert-status"></div>
                                </div>
                                <div>
                                    <div class="font-semibold text-dark text-base md:text-lg" id="current-expert-name">
                                        Pilih dokter untuk konsultasi
                                    </div>
                                    <div class="text-sm text-gray-600" id="current-expert-specialty">
                                        Request konsultasi dulu
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
                            <!-- Welcome Message - Enhanced -->
                            <div class="text-center mb-6 empty-state">
                                <div
                                    class="inline-block bg-white rounded-3xl px-6 md:px-8 py-6 md:py-8 shadow-lg max-w-md border border-gray-100">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-comments text-3xl text-white"></i>
                                    </div>
                                    <h4 class="font-semibold text-dark mb-2 text-lg">Selamat Datang</h4>
                                    <p class="text-sm text-gray-600 leading-relaxed">
                                        Minta konsultasi terlebih dahulu.<br>
                                        Chat akan aktif setelah diterima dokter.
                                    </p>
                                </div>
                            </div>

                            <div id="chat-messages"></div>

                            <!-- Typing Indicator -->
                            <div class="flex items-center space-x-2 mb-4 hidden" id="typing-indicator">
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user-md text-gray-500 text-sm"></i>
                                </div>
                                <div class="bg-gray-200 px-4 py-3 rounded-2xl">
                                    <div class="typing-indicator">
                                        <div class="typing-dot"></div>
                                        <div class="typing-dot"></div>
                                        <div class="typing-dot"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Suggested Messages - Improved -->
                        <div class="p-3 md:p-4 border-t border-gray-100 bg-gray-50" id="suggested-container">
                            <div class="flex flex-wrap gap-2" id="suggested-messages">
                                <!-- Suggestions will be rendered here -->
                            </div>
                        </div>

                        <!-- Input Area - Fixed Position -->
                        <div class="chat-input-wrapper border-t border-gray-200 bg-white">
                            <!-- Preview Area di ATAS input -->
                            <div id="file-preview" class="mb-3 hidden preview-container">
                                <div
                                    class="flex items-center justify-between bg-gray-50 rounded-lg p-3 border border-gray-200">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-file text-primary text-xl"></i>
                                        <div>
                                            <div id="file-name" class="font-medium text-sm"></div>
                                            <div id="file-size" class="text-xs text-gray-500"></div>
                                        </div>
                                    </div>
                                    <button type="button" id="remove-file"
                                        class="text-gray-400 hover:text-red-500 transition">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Image Preview di ATAS input -->
                            <div id="image-preview" class="mb-3 hidden preview-container">
                                <div class="relative inline-block">
                                    <img id="preview-image"
                                        class="max-w-xs rounded-lg border-2 border-primary shadow-sm">
                                    <button type="button" id="remove-image"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Form Input -->
                            <div class="flex items-center space-x-2 md:space-x-3">
                                <!-- File Input Hidden -->
                                <input type="file" id="file-input" class="hidden"
                                    accept="image/*,.pdf,.doc,.docx,.txt">

                                <!-- Attachment Button -->
                                <button type="button" id="attachment-button"
                                    class="w-10 h-10 flex-shrink-0 flex items-center justify-center text-gray-400 hover:text-primary transition rounded-full hover:bg-gray-100">
                                    <i class="fas fa-paperclip text-lg"></i>
                                </button>

                                <!-- Message Input -->
                                <div class="flex-1">
                                    <input type="text" placeholder="Ketik pesan Anda..."
                                        class="w-full px-4 md:px-5 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-sm md:text-base"
                                        id="message-input" disabled>
                                </div>

                                <!-- Send Button -->
                                <button
                                    class="w-12 h-12 flex-shrink-0 btn-primary rounded-full flex items-center justify-center text-white disabled:opacity-50 transition-all"
                                    id="send-button" disabled>
                                    <i class="fas fa-paper-plane text-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Request Konsultasi - Enhanced -->
    <div id="consultation-modal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 modal-overlay flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl w-full max-w-md modal-content shadow-2xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-primary bg-opacity-10 rounded-full flex items-center justify-center">
                            <i class="fas fa-comment-medical text-primary"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark">Request Konsultasi</h3>
                    </div>
                    <button id="close-modal"
                        class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <p class="text-sm text-gray-600 mb-4">Jelaskan alasan Anda membutuhkan konsultasi</p>
                <textarea id="consultation-reason"
                    class="w-full border border-gray-300 rounded-xl p-4 mb-4 focus:outline-none focus:ring-2 focus:ring-primary transition resize-none text-sm"
                    rows="4" placeholder="Tulis alasan konsultasi..."></textarea>
                <div class="flex flex-col sm:flex-row justify-end gap-2">
                    <button id="cancel-consultation"
                        class="px-6 py-3 bg-gray-200 hover:bg-gray-300 rounded-xl transition font-medium text-sm">
                        Batal
                    </button>
                    <button id="submit-consultation"
                        class="px-6 py-3 btn-primary text-white rounded-xl font-medium text-sm">
                        Kirim Request
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center mr-2">
                            <i class="fas fa-heartbeat text-white"></i>
                        </div>
                        <span class="text-xl font-bold">OBESIFIT</span>
                    </div>
                    <p class="text-gray-400 mt-2">Platform Edukasi Obesitas Interaktif</p>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-gray-400">&copy; 2025 OBESIFIT. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // ===============================
        // Variabel global
        // ===============================
        const sessions = {};
        let selectedDoctorId = null;
        let currentFile = null;
        let currentFileType = null;
        let activeSessionId = null;
        let lastLoadedCount = 0;
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // ===============================
        // Fungsi Backend
        // ===============================
        async function fetchDoctors() {
            try {
                const res = await fetch('/doctors', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('Gagal ambil dokter');
                const doctors = await res.json();
                renderDoctors(doctors);
            } catch (err) {
                console.error('Gagal ambil daftar dokter', err);
            }
        }

        async function fetchPatientConsultations() {
            try {
                const res = await fetch('/consultations/patient', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) return [];
                const consultations = await res.json();
                return consultations;
            } catch (err) {
                console.error('Gagal ambil consultations pasien', err);
                return [];
            }
        }

        async function fetchConsultationId(doctorId) {
            try {
                const consultations = await fetchPatientConsultations();
                const approved = consultations.find(c => c.doctor_id === doctorId && c.status === 'approved');
                return approved ? approved.id : null;
            } catch (err) {
                console.error(err);
                return null;
            }
        }

        // ===============================
        // Render Dokter
        // ===============================
        async function renderDoctors(doctors) {
            const container = document.getElementById('doctors-list');
            const countEl = document.getElementById('doctor-count');
            container.innerHTML = '';

            let requests = [];
            try {
                const res = await fetch('/consultations/patient', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (res.ok) {
                    requests = await res.json();
                }
            } catch (err) {
                console.error('Gagal ambil request pasien', err);
            }

            doctors.sort((a, b) => {
                if (a.is_online && !b.is_online) return -1;
                if (!a.is_online && b.is_online) return 1;
                const aTime = a.practice_start_time || '00:00';
                const bTime = b.practice_start_time || '00:00';
                return aTime.localeCompare(bTime);
            });

            countEl.textContent = doctors.length;

            doctors.forEach(doctor => {
                const idKey = `doctor-${doctor.id}`;

                const now = new Date();
                let canRequest = true;
                if (doctor.practice_start_time && doctor.practice_end_time) {
                    const [startH, startM] = doctor.practice_start_time.split(':').map(Number);
                    const [endH, endM] = doctor.practice_end_time.split(':').map(Number);

                    const startTime = new Date();
                    startTime.setHours(startH, startM, 0);
                    const endTime = new Date();
                    endTime.setHours(endH, endM, 0);

                    if (now < startTime || now > endTime) canRequest = false;
                }

                if (!sessions[idKey]) {
                    sessions[idKey] = {
                        status: 'ready',
                        expert: doctor,
                        messages: [],
                        consultation_id: null
                    };
                }

                const latestRequest = requests.find(r => r.doctor_id === doctor.id);

                if (latestRequest) {
                    sessions[idKey].status = latestRequest.status;
                    sessions[idKey].consultation_id = latestRequest.id || null;
                } else if (sessions[idKey].status === 'pending' || sessions[idKey].status === 'approved') {
                    // keep existing status
                }

                let btnText = 'Minta Konsultasi';
                let btnDisabled = !canRequest;
                let statusBadge = '';

                switch (sessions[idKey].status) {
                    case 'pending':
                        btnText = 'Menunggu...';
                        btnDisabled = true;
                        statusBadge =
                            '<span class="status-badge status-pending"><i class="fas fa-clock mr-1 text-xs"></i>Pending</span>';
                        break;
                    case 'approved':
                        btnText = 'Mulai Chat';
                        btnDisabled = false;
                        statusBadge =
                            '<span class="status-badge status-approved"><i class="fas fa-check-circle mr-1 text-xs"></i>Disetujui</span>';
                        break;
                    case 'complete':
                    case 'rejected':
                        btnText = 'Minta Konsultasi';
                        btnDisabled = !canRequest;
                        sessions[idKey].status = 'ready';
                        break;
                    default:
                        if (doctor.is_online && canRequest) {
                            statusBadge =
                                '<span class="status-badge status-online"><i class="fas fa-circle mr-1 text-xs"></i>Online</span>';
                        } else {
                            statusBadge =
                                '<span class="status-badge status-offline"><i class="fas fa-circle mr-1 text-xs"></i>Offline</span>';
                        }
                }

                const div = document.createElement('div');
                div.className =
                    'consultation-card p-4 bg-white rounded-xl shadow-sm border border-gray-100 hover:border-primary';

                const btnClass = btnDisabled ?
                    'w-full py-2.5 rounded-xl font-medium text-sm bg-gray-200 text-gray-500 cursor-not-allowed' :
                    'w-full py-2.5 rounded-xl font-medium text-sm btn-primary text-white';

                div.innerHTML = `
                <div class="flex items-start space-x-3 mb-3">
                    <img src="${doctor.profile_photo || '/img/default-user.jpg'}" 
                         alt="${doctor.first_name}" 
                         class="doctor-avatar w-12 h-12 rounded-full object-cover ring-2 ring-gray-100">
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-dark truncate">${doctor.first_name} ${doctor.last_name}</div>
                        <div class="text-sm text-gray-600 truncate">${doctor.specialization || '-'}</div>
                    </div>
                </div>
                <div class="space-y-2 mb-3 text-xs">
                    <div class="flex items-center text-gray-500">
                        <i class="fas fa-calendar-alt w-4 mr-2 text-primary"></i>
                        <span class="truncate">${doctor.practice_days || '-'}</span>
                    </div>
                    <div class="flex items-center text-gray-500">
                        <i class="fas fa-clock w-4 mr-2 text-primary"></i>
                        <span>${doctor.practice_start_time || '-'} - ${doctor.practice_end_time || '-'}</span>
                    </div>
                </div>
                <div class="flex items-center justify-between mb-3">
                    ${statusBadge}
                </div>
                <button id="request-${idKey}" class="${btnClass}" ${btnDisabled ? 'disabled' : ''}>
                    ${btnText}
                </button>
            `;
                container.appendChild(div);

                const btn = document.getElementById(`request-${idKey}`);

                btn.addEventListener('click', async () => {
                    if (btnDisabled) return;

                    if (sessions[idKey].status === 'ready') {
                        selectedDoctorId = doctor.id;
                        document.getElementById('consultation-modal').classList.remove('hidden');
                    } else if (sessions[idKey].status === 'approved') {
                        const consId = await fetchConsultationId(doctor.id);
                        if (!consId) {
                            alert('Gagal ambil consultation ID. Coba refresh halaman.');
                            return;
                        }
                        sessions[idKey].consultation_id = consId;
                        selectSession(idKey);
                    }
                });
            });
        }

        // ===============================
        // Modal Handlers
        // ===============================
        document.getElementById('cancel-consultation').addEventListener('click', () => {
            document.getElementById('consultation-modal').classList.add('hidden');
            selectedDoctorId = null;
            document.getElementById('consultation-reason').value = '';
        });

        document.getElementById('close-modal').addEventListener('click', () => {
            document.getElementById('consultation-modal').classList.add('hidden');
            selectedDoctorId = null;
            document.getElementById('consultation-reason').value = '';
        });

        document.getElementById('submit-consultation').addEventListener('click', async () => {
            const reason = document.getElementById('consultation-reason').value.trim();
            if (!selectedDoctorId) return;

            const idKey = `doctor-${selectedDoctorId}`;
            const btn = document.getElementById(`request-${idKey}`);

            try {
                btn.disabled = true;
                btn.textContent = 'Mengirim...';

                const res = await fetch('/consultations', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        doctor_id: selectedDoctorId,
                        reason: reason
                    })
                });

                if (!res.ok) throw new Error('Gagal request konsultasi');
                const data = await res.json();

                sessions[idKey].status = 'pending';
                sessions[idKey].consultation_id = data.id || null;
                btn.disabled = true;
                btn.textContent = 'Menunggu Persetujuan...';

                document.getElementById('consultation-modal').classList.add('hidden');
                document.getElementById('consultation-reason').value = '';
                selectedDoctorId = null;
            } catch (err) {
                alert(err.message || 'Gagal mengirim request');
                btn.disabled = false;
                btn.textContent = 'Minta Konsultasi';
                document.getElementById('consultation-modal').classList.add('hidden');
            }
        });

        // ===============================
        // Fungsi pilih dokter & buka chat
        // ===============================
        async function selectSession(sessionId) {
            activeSessionId = sessionId;
            lastLoadedCount = 0;

            const session = sessions[sessionId];
            const doctor = session.expert;

            document.getElementById('current-expert-name').textContent = doctor.first_name + ' ' + doctor.last_name;
            document.getElementById('current-expert-specialty').textContent = doctor.specialization || '-';
            document.getElementById('current-expert-avatar').src = doctor.profile_photo || '/img/default-user.jpg';
            document.getElementById('current-expert-status').className =
                'online-dot absolute bottom-0 right-0 border-2 border-white';

            document.getElementById('message-input').disabled = false;
            document.getElementById('send-button').disabled = false;

            // Load chat history dari backend (jika consultation_id tersedia)
            if (!session.consultation_id) {
                session.consultation_id = await fetchConsultationId(doctor.id);
            }

            if (session.consultation_id) {
                await loadChatHistory(session);
            } else {
                session.messages = [];
                renderMessages(session.messages);
            }
        }

        // ===============================
        // Load chat dari backend
        // ===============================
        async function loadChatHistory(session) {
            try {
                const res = await fetch(`/consultations/${session.consultation_id}/chats`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('Gagal load chat');
                const chats = await res.json();
                session.messages = chats.map(c => ({
                    type: c.sender_id === session.expert.id ? 'expert' : 'user',
                    text: c.message,
                    time: (new Date(c.created_at)).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    }),
                    raw: c
                }));
                renderMessages(session.messages);
                scrollToBottom();
            } catch (err) {
                console.error('Gagal load chat history', err);
            }
        }

        // ===============================
        // Render pesan chat dengan attachment support
        // ===============================
        function renderMessages(messages) {
            const chatMessages = document.getElementById('chat-messages');
            chatMessages.innerHTML = '';

            messages.forEach(message => {
                const el = document.createElement('div');
                el.className = `flex mb-4 ${message.type === 'user' ? 'justify-end' : 'justify-start'}`;

                let messageContent = '';

                // Cek jika ada attachment
                if (message.raw.attachment_path) {
                    const attachmentType = message.raw.type;

                    if (attachmentType === 'image') {
                        messageContent = `
                        <div class="mb-2">
                            <img src="/storage/${message.raw.attachment_path}" 
                                 alt="Gambar" 
                                 class="max-w-xs rounded-lg cursor-pointer hover:opacity-90 transition border border-gray-200"
                                 onclick="openImageModal('/storage/${message.raw.attachment_path}')">
                        </div>
                        ${message.raw.message && message.raw.message !== '[Mengirim gambar]' ? 
                          `<div class="text-sm mt-2">${escapeHtml(message.raw.message)}</div>` : ''}
                    `;
                    } else {
                        // Untuk file non-gambar
                        const fileName = message.raw.attachment_path.split('/').pop() || 'File';
                        messageContent = `
                        <div class="flex items-center space-x-3 bg-white p-3 rounded-lg border border-gray-200 mb-2">
                            <i class="fas fa-file text-primary text-xl"></i>
                            <div class="flex-1">
                                <div class="font-medium text-sm text-gray-500">${escapeHtml(fileName)}</div>
                                <div class="text-xs text-gray-500">File</div>
                            </div>
                            <a href="/storage/${message.raw.attachment_path}" 
                               download="${fileName}"
                               class="text-primary hover:text-secondary transition">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                        ${message.raw.message && message.raw.message !== '[Mengirim file]' ? 
                          `<div class="text-sm mt-2">${escapeHtml(message.raw.message)}</div>` : ''}
                    `;
                    }
                } else {
                    // Pesan teks biasa
                    messageContent = escapeHtml(message.text);
                }

                el.innerHTML = `
                <div class="max-w-xs lg:max-w-md">
                    <div class="${message.type === 'user' ? 'message-user' : 'message-expert'} px-4 py-2">
                        ${messageContent}
                    </div>
                    <div class="text-xs text-gray-500 mt-1 ${message.type === 'user' ? 'text-right' : 'text-left'}">
                        ${escapeHtml(message.time)}
                    </div>
                </div>
            `;
                chatMessages.appendChild(el);
            });

            scrollToBottom();
        }

        // ===============================
        // File Handling Functions
        // ===============================
        function handleFileSelect(event) {
            const file = event.target.files[0];
            if (!file) return;

            currentFile = file;

            // Cek tipe file
            if (file.type.startsWith('image/')) {
                currentFileType = 'image';
                showImagePreview(file);
            } else {
                currentFileType = 'file';
                showFilePreview(file);
            }

            // Clear text input
            document.getElementById('message-input').value = '';
        }

        function showImagePreview(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
                document.getElementById('file-preview').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }

        function showFilePreview(file) {
            document.getElementById('file-name').textContent = file.name;
            document.getElementById('file-size').textContent = formatFileSize(file.size);
            document.getElementById('file-preview').classList.remove('hidden');
            document.getElementById('image-preview').classList.add('hidden');
        }

        function clearFile() {
            currentFile = null;
            currentFileType = null;
            document.getElementById('file-input').value = '';
            document.getElementById('file-preview').classList.add('hidden');
            document.getElementById('image-preview').classList.add('hidden');
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // ===============================
        // Kirim pesan (support text dan file)
        // ===============================
        async function sendMessage() {
            const input = document.getElementById('message-input');
            const text = input.value.trim();

            // Jika tidak ada file dan tidak ada text, return
            if (!currentFile && !text) return;

            if (!activeSessionId) return;

            const session = sessions[activeSessionId];

            if (!session.consultation_id) {
                alert('Konsultasi belum aktif. Pastikan dokter sudah menyetujui request.');
                return;
            }

            // Disable input sementara
            document.getElementById('send-button').disabled = true;

            try {
                const formData = new FormData();
                formData.append('consultation_id', session.consultation_id);

                // Jika ada file, kirim text atau default message
                if (currentFile) {
                    if (text) {
                        formData.append('message', text);
                    } else {
                        // Default message berdasarkan tipe file
                        if (currentFileType === 'image') {
                            formData.append('message', '[Mengirim gambar]');
                        } else {
                            formData.append('message', '[Mengirim file]');
                        }
                    }
                    formData.append('attachment', currentFile);
                    formData.append('type', currentFileType);
                } else {
                    // Jika hanya text
                    formData.append('message', text);
                    formData.append('type', 'text');
                }

                const res = await fetch('/chats', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                if (!res.ok) {
                    const err = await res.json().catch(() => ({}));
                    throw new Error(err.message || 'Gagal mengirim pesan');
                }

                const saved = await res.json();

                // Tambahkan ke UI
                session.messages.push({
                    type: 'user',
                    text: saved.message,
                    time: getTime(),
                    raw: saved
                });

                renderMessages(session.messages);

                // Reset form
                input.value = '';
                clearFile();

            } catch (err) {
                alert(err.message || 'Gagal mengirim pesan');
            } finally {
                document.getElementById('send-button').disabled = false;
            }
        }

        // ===============================
        // Riwayat Konsultasi
        // ===============================
        async function fetchConsultationHistory() {
            try {
                const res = await fetch('/consultations/patient?status=complete', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('Gagal ambil riwayat konsultasi');
                const histories = await res.json();
                renderConsultationHistory(histories);
            } catch (err) {
                console.error(err);
                document.getElementById('history-list').innerHTML =
                    '<p class="text-sm text-gray-500">Gagal memuat riwayat.</p>';
            }
        }

        function renderConsultationHistory(histories) {
            const container = document.getElementById('history-list');
            container.innerHTML = '';

            if (!histories.length) {
                container.innerHTML = '<p class="text-sm text-gray-500">Belum ada riwayat.</p>';
                return;
            }

            histories.forEach(h => {
                const div = document.createElement('div');
                div.className =
                    'consultation-card p-3 bg-white rounded-2xl shadow-sm border border-gray-200 cursor-pointer hover:shadow-md';
                div.innerHTML = `
                <div class="font-semibold text-dark">${h.doctor.first_name} ${h.doctor.last_name}</div>
                <div class="text-sm text-gray-600">${h.doctor.specialization || '-'}</div>
                <div class="text-xs text-gray-500 mt-1">${new Date(h.created_at).toLocaleDateString()} - Selesai</div>
            `;
                div.addEventListener('click', async () => {
                    const sessionId = `history-${h.id}`;
                    sessions[sessionId] = {
                        status: 'complete',
                        expert: h.doctor,
                        messages: [],
                        consultation_id: h.id
                    };
                    selectHistorySession(sessionId);
                });
                container.appendChild(div);
            });
        }

        async function selectHistorySession(sessionId) {
            activeSessionId = sessionId;
            lastLoadedCount = 0;

            const session = sessions[sessionId];
            const doctor = session.expert;

            document.getElementById('current-expert-name').textContent = doctor.first_name + ' ' + doctor.last_name;
            document.getElementById('current-expert-specialty').textContent = doctor.specialization || '-';
            document.getElementById('current-expert-avatar').src = doctor.profile_photo || '/img/default-user.jpg';
            document.getElementById('current-expert-status').className =
                'online-dot absolute bottom-0 right-0 border-2 border-white';

            // Nonaktifkan input
            document.getElementById('message-input').disabled = true;
            document.getElementById('send-button').disabled = true;

            // Load chat history
            try {
                const res = await fetch(`/consultations/${session.consultation_id}/chats`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('Gagal load chat');
                const chats = await res.json();
                session.messages = chats.map(c => ({
                    type: c.sender_id === doctor.id ? 'expert' : 'user',
                    text: c.message,
                    time: (new Date(c.created_at)).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    }),
                    raw: c
                }));
                renderMessages(session.messages);
            } catch (err) {
                console.error(err);
            }
        }

        // ===============================
        // Modal untuk preview gambar besar
        // ===============================
        function openImageModal(imageUrl) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4';
            modal.innerHTML = `
            <div class="relative max-w-4xl max-h-full">
                <img src="${imageUrl}" class="max-w-full max-h-full rounded-lg">
                <button class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300 transition" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
                <a href="${imageUrl}" download class="absolute top-4 left-4 text-white text-xl hover:text-gray-300 transition">
                    <i class="fas fa-download"></i>
                </a>
            </div>
        `;
            document.body.appendChild(modal);

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.remove();
                }
            });
        }

        // ===============================
        // Fungsi Bantuan
        // ===============================
        function getTime() {
            const now = new Date();
            return now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
        }

        function escapeHtml(unsafe) {
            return String(unsafe)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function scrollToBottom() {
            const container = document.querySelector('.messages-container');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        }

        // ===============================
        // Suggested Messages
        // ===============================
        const suggestedMessages = [
            "Saya ingin konsultasi tentang diet saya",
            "Saya mengalami masalah pencernaan",
            "Saya ingin cek perkembangan berat badan saya",
            "Bolehkah saya minta saran olahraga ringan?"
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

        // ===============================
        // Event Listeners
        // ===============================
        document.getElementById('send-button').addEventListener('click', sendMessage);
        document.getElementById('message-input').addEventListener('keypress', e => {
            if (e.key === 'Enter') sendMessage();
        });

        document.getElementById('attachment-button').addEventListener('click', () => {
            document.getElementById('file-input').click();
        });

        document.getElementById('file-input').addEventListener('change', handleFileSelect);
        document.getElementById('remove-file').addEventListener('click', clearFile);
        document.getElementById('remove-image').addEventListener('click', clearFile);

        // ===============================
        // Auto Refresh Chat
        // ===============================
        setInterval(async () => {
            if (!activeSessionId) return;

            const session = sessions[activeSessionId];
            if (!session || !session.consultation_id) return;

            try {
                const res = await fetch(`/consultations/${session.consultation_id}/chats`);
                const data = await res.json();

                if (data.length !== lastLoadedCount) {
                    session.messages = data.map(c => ({
                        type: c.sender_id === session.expert.id ? 'expert' : 'user',
                        text: c.message,
                        time: new Date(c.created_at).toLocaleTimeString([], {
                            hour: "2-digit",
                            minute: "2-digit"
                        }),
                        raw: c
                    }));

                    renderMessages(session.messages);
                    lastLoadedCount = data.length;
                }
            } catch (err) {
                console.error("Refresh error:", err);
            }
        }, 2000);

        // ===============================
        // Inisialisasi
        // ===============================
        renderSuggestedMessages();
        fetchDoctors();
        fetchConsultationHistory();
    </script>
</body>

</html>
