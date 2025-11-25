<style>
    /* Navbar Animations - Admin */
    .navbar-shadow {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.3s ease;
    }

    .navbar-shadow:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    /* Mobile Menu Animation */
    #mobile-menu {
        animation: slideDown 0.3s ease-out;
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

    /* Dropdown Animations */
    .dropdown-enter {
        animation: dropdownSlide 0.2s ease-out;
    }

    @keyframes dropdownSlide {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Logo Pulse - Admin */
    .logo-icon {
        transition: transform 0.3s ease;
    }

    .logo-icon:hover {
        transform: scale(1.1) rotate(5deg);
    }

    /* Nav Links Hover Effect - Admin */
    .nav-link {
        position: relative;
        transition: all 0.3s ease;
        padding: 8px 12px;
        border-radius: 6px;
    }

    .nav-link:hover {
        color: #4EAC92;
        background-color: rgba(78, 172, 146, 0.08);
        transform: translateY(-1px);
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 50%;
        width: 0;
        height: 2px;
        background: #4EAC92;
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-link:hover::after {
        width: 80%;
    }

    /* Notification Badge Pulse */
    #notif-badge {
        animation: badgePulse 2s infinite;
    }

    @keyframes badgePulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    /* Profile Avatar Border Animation - Admin */
    .profile-avatar {
        transition: all 0.3s ease;
    }

    .profile-avatar:hover {
        transform: scale(1.05);
        box-shadow: 0 0 0 3px rgba(78, 172, 146, 0.3);
    }

    /* Notification Item Hover */
    .notif-item {
        transition: all 0.2s ease;
        border-radius: 8px;
        margin: 2px 4px;
    }

    .notif-item:hover {
        transform: translateX(4px);
        background-color: rgba(78, 172, 146, 0.05) !important;
    }

    /* Mobile Menu Toggle Icon Animation */
    .menu-icon {
        transition: transform 0.3s ease;
    }

    .menu-icon.active {
        transform: rotate(90deg);
    }

    /* Notification Dropdown Custom Scrollbar */
    #notif-list::-webkit-scrollbar,
    #notif-modal-list::-webkit-scrollbar {
        width: 6px;
    }

    #notif-list::-webkit-scrollbar-track,
    #notif-modal-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    #notif-list::-webkit-scrollbar-thumb,
    #notif-modal-list::-webkit-scrollbar-thumb {
        background: #4EAC92;
        border-radius: 10px;
    }

    #notif-list::-webkit-scrollbar-thumb:hover,
    #notif-modal-list::-webkit-scrollbar-thumb:hover {
        background: #3A8C74;
    }

    /* Modal Backdrop Blur */
    .modal-backdrop {
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

    /* Modal Content Animation */
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

    /* Button Hover Effects - Admin */
    .btn-mark-read {
        transition: all 0.3s ease;
    }

    .btn-mark-read:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(78, 172, 146, 0.2);
        background-color: rgba(255, 255, 255, 0.3) !important;
    }

    /* Unread Notification Indicator */
    .unread-dot {
        animation: dotPulse 2s infinite;
    }

    @keyframes dotPulse {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.7;
            transform: scale(1.2);
        }
    }

    /* Mobile User Card - Admin */
    .mobile-user-card {
        background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
        border-radius: 12px;
        padding: 16px;
        border: 1px solid rgba(78, 172, 146, 0.1);
    }

    /* Admin Badge Styling */
    .admin-badge {
        background: linear-gradient(135deg, #4EAC92, #3A8C74);
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        margin-left: 8px;
    }

    /* Icon Hover Effects - Admin */
    .nav-icon {
        transition: all 0.3s ease;
    }

    .nav-icon:hover {
        color: #4EAC92;
        transform: scale(1.1);
    }

    /* Dropdown Menu Items Hover - Admin */
    #dropdown-menu a,
    #dropdown-menu button {
        transition: all 0.2s ease;
        border-radius: 6px;
        margin: 2px 8px;
    }

    #dropdown-menu a:hover,
    #dropdown-menu button:hover {
        background-color: rgba(78, 172, 146, 0.08);
        transform: translateX(4px);
    }

    /* Mobile Menu Items Hover - Admin */
    #mobile-menu a,
    #mobile-menu button {
        transition: all 0.2s ease;
        border-radius: 8px;
    }

    #mobile-menu a:hover,
    #mobile-menu button:hover {
        background-color: rgba(78, 172, 146, 0.08);
        transform: translateX(4px);
    }

    /* Notification Toggle Hover */
    #notif-toggle {
        transition: all 0.3s ease;
        border-radius: 50%;
    }

    #notif-toggle:hover {
        background-color: rgba(78, 172, 146, 0.1);
        transform: scale(1.05);
    }

    /* Dropdown Toggle Hover - Admin */
    #dropdown-toggle {
        transition: all 0.3s ease;
        border-radius: 8px;
    }

    #dropdown-toggle:hover {
        background-color: rgba(78, 172, 146, 0.08);
    }

    /* Mobile Menu Button Hover */
    #mobile-menu-button {
        transition: all 0.3s ease;
        border-radius: 8px;
    }

    #mobile-menu-button:hover {
        background-color: rgba(78, 172, 146, 0.1);
        transform: scale(1.05);
    }

    /* Gradient Text Effect for Admin */
    .admin-gradient {
        background: linear-gradient(135deg, #4EAC92, #3A8C74);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Responsive Text Sizing */
    @media (max-width: 768px) {
        .text-responsive {
            font-size: 0.875rem;
        }

        .nav-link {
            padding: 12px 16px;
            margin: 2px 0;
        }
    }

    /* Smooth transitions for all interactive elements */
    button,
    a,
    .nav-link,
    .profile-avatar,
    .logo-icon {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Focus states for accessibility */
    button:focus-visible,
    a:focus-visible,
    .nav-link:focus-visible {
        outline: 2px solid #4EAC92;
        outline-offset: 2px;
        border-radius: 4px;
    }

    /* Active state for mobile menu */
    #mobile-menu a:active,
    #mobile-menu button:active {
        transform: scale(0.98);
        background-color: rgba(78, 172, 146, 0.15);
    }
</style>

<header class="bg-white navbar-shadow sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <div
                    class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mr-3 logo-icon cursor-pointer">
                    <i class="fas fa-heartbeat text-white text-xl"></i>
                </div>
                <span class="text-xl font-bold text-dark">OBESIFIT</span>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button"
                class="md:hidden text-dark focus:outline-none p-2 hover:bg-gray-100 rounded-lg transition">
                <i class="fas fa-bars text-xl menu-icon"></i>
            </button>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-6 lg:space-x-8">
                <a href="/dashboard" class="nav-link text-dark hover:text-primary font-medium py-2">Beranda</a>
                <a href="/articles-videos" class="nav-link text-dark hover:text-primary font-medium py-2">Artikel &
                    Video</a>

                {{-- Tampilkan menu Konsultasi hanya jika role user --}}
                @if (Auth::check() && Auth::user()->isUser())
                    @if (Auth::user()->hasActiveSubscription())
                        <a href="/konsultasi" class="nav-link text-dark hover:text-primary font-medium py-2">
                            <span>👑</span>
                            <span>Konsultasi</span>
                        </a>
                    @else
                        <a href="/dashboard#konsul_dokter"
                            class="nav-link text-secondary hover:text-primary font-medium py-2 flex items-center gap-1">
                            <span>👑</span>
                            <span>Konsultasi</span>
                        </a>
                    @endif
                @endif

                <a href="/dashboard#kalkulator"
                    class="nav-link text-dark hover:text-primary font-medium py-2">Kalkulator</a>

                {{-- Tampilkan Panel Dokter hanya untuk role doctor --}}
                @if (Auth::check() && Auth::user()->isDoctor())
                    <a href="/doctor-menu" class="nav-link text-dark hover:text-primary font-medium py-2">Panel
                        Dokter</a>
                @endif
            </nav>

            <!-- Desktop Icons -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- Notification Icon -->
                <div class="relative" id="notif-wrapper">
                    <button id="notif-toggle"
                        class="relative focus:outline-none p-2 hover:bg-gray-100 rounded-full transition">
                        <i class="fas fa-bell text-xl text-gray-600 hover:text-primary transition"></i>

                        <!-- Badge -->
                        <span id="notif-badge"
                            class="absolute top-0 right-0 bg-red-600 text-white text-xs px-1.5 py-0.5 rounded-full hidden min-w-[18px] text-center font-semibold">
                            0
                        </span>
                    </button>

                    <!-- Dropdown Notifications -->
                    <div id="notif-dropdown"
                        class="absolute right-0 mt-2 w-80 lg:w-96 bg-white rounded-xl shadow-2xl border border-gray-100 hidden z-50 dropdown-enter">

                        <div
                            class="px-4 py-3 border-b bg-gradient-to-r from-primary to-secondary text-white rounded-t-xl">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-base">Notifikasi</span>
                                <button id="notif-read-all-btn"
                                    class="text-white text-xs bg-white bg-opacity-20 px-3 py-1 rounded-full hover:bg-opacity-30 transition btn-mark-read">
                                    Tandai Semua
                                </button>
                            </div>
                        </div>

                        <div id="notif-list" class="max-h-80 overflow-y-auto">
                            <div class="flex items-center justify-center py-8">
                                <i class="fas fa-spinner fa-spin text-2xl text-primary mr-2"></i>
                                <p class="text-gray-500 text-sm">Memuat...</p>
                            </div>
                        </div>

                        <a href="#" id="open-notif-modal"
                            class="block text-center text-primary py-3 border-t hover:bg-gray-50 text-sm font-medium transition rounded-b-xl">
                            Lihat Semua Notifikasi
                        </a>
                    </div>
                </div>

                <!-- User Profile Dropdown -->
                <div class="relative" id="user-dropdown">
                    <button id="dropdown-toggle"
                        class="flex items-center space-x-2 focus:outline-none hover:bg-gray-100 px-3 py-2 rounded-lg transition">
                        <div
                            class="w-10 h-10 bg-primary rounded-full overflow-hidden border-2 border-primary profile-avatar">
                            <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('img/user-avatar.jpg') }}"
                                alt="Profile" class="w-full h-full object-cover"
                                onerror="this.src='/img/default-user.jpg'">
                        </div>
                        <span class="text-dark font-medium hidden lg:inline-block">{{ Auth::user()->first_name }}</span>
                        <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform" id="chevron-icon"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdown-menu"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-100 py-2 hidden z-50 dropdown-enter">

                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-dark">{{ Auth::user()->first_name }}
                                {{ Auth::user()->last_name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="{{ route('profile') }}"
                            class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition">
                            <i class="fas fa-user mr-3 text-primary w-5"></i>
                            <span class="text-sm font-medium">Profil Saya</span>
                        </a>

                        <div class="border-t border-gray-100 my-1"></div>

                        <form method="POST" action="{{ route('logout') }}" class="inline w-full">
                            @csrf
                            <button type="submit"
                                class="flex items-center w-full px-4 py-3 text-red-600 hover:bg-red-50 transition">
                                <i class="fas fa-sign-out-alt mr-3 w-5"></i>
                                <span class="text-sm font-medium">Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col space-y-3">
                <a href="/dashboard"
                    class="text-dark hover:text-primary hover:bg-gray-50 font-medium px-4 py-3 rounded-lg transition">
                    <i class="fas fa-home mr-3 text-primary w-5"></i>Beranda
                </a>
                <a href="/articles-videos"
                    class="text-dark hover:text-primary hover:bg-gray-50 font-medium px-4 py-3 rounded-lg transition">
                    <i class="fas fa-newspaper mr-3 text-primary w-5"></i>Artikel & Video
                </a>

                {{-- Tampilkan menu Konsultasi hanya untuk user --}}
                @if (Auth::check() && Auth::user()->isUser())
                    <a href="/konsultasi"
                        class="text-dark hover:text-primary hover:bg-gray-50 font-medium px-4 py-3 rounded-lg transition">
                        <i class="fas fa-comments mr-3 text-primary w-5"></i>Konsultasi
                    </a>
                @endif

                <a href="/dashboard#kalkulator"
                    class="text-dark hover:text-primary hover:bg-gray-50 font-medium px-4 py-3 rounded-lg transition">
                    <i class="fas fa-calculator mr-3 text-primary w-5"></i>Kalkulator Kesehatan
                </a>

                {{-- Panel Dokter hanya untuk dokter --}}
                @if (Auth::check() && Auth::user()->isDoctor())
                    <a href="/doctor-menu"
                        class="text-dark hover:text-primary hover:bg-gray-50 font-medium px-4 py-3 rounded-lg transition">
                        <i class="fas fa-user-md mr-3 text-primary w-5"></i>Panel Dokter
                    </a>
                @endif

                <!-- Mobile Notifications -->
                <button id="mobile-notif-btn"
                    class="flex items-center justify-between text-dark hover:text-primary hover:bg-gray-50 font-medium px-4 py-3 rounded-lg transition text-left">
                    <span>
                        <i class="fas fa-bell mr-3 text-primary w-5"></i>Notifikasi
                    </span>
                    <span id="mobile-notif-badge"
                        class="bg-red-600 text-white text-xs px-2 py-1 rounded-full hidden font-semibold">0</span>
                </button>

                <!-- Mobile User Info -->
                <div class="pt-4 border-t border-gray-200">
                    <div class="mobile-user-card">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-14 h-14 bg-primary rounded-full overflow-hidden border-2 border-primary">
                                <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('img/user-avatar.jpg') }}"
                                    alt="Profile" class="w-full h-full object-cover"
                                    onerror="this.src='/img/default-user.jpg'">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-dark truncate">{{ Auth::user()->first_name }}
                                    {{ Auth::user()->last_name }}</p>
                                <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('profile') }}"
                                class="flex items-center justify-center px-4 py-2.5 text-primary font-medium border-2 border-primary rounded-lg hover:bg-primary hover:text-white transition">
                                <i class="fas fa-user mr-2"></i>Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg hover:from-red-600 hover:to-red-700 transition shadow-sm">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Notification Modal -->
<div id="notif-modal"
    class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop flex justify-center items-center hidden z-50 p-4">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl modal-content">
        <div class="bg-gradient-to-r from-primary to-secondary text-white p-5 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold">Semua Notifikasi</h2>
                <button onclick="document.getElementById('notif-modal').classList.add('hidden')"
                    class="text-white hover:bg-white hover:bg-opacity-20 p-2 rounded-full transition">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>

        <div id="notif-modal-list" class="max-h-96 overflow-y-auto p-4">
            <div class="flex items-center justify-center py-8">
                <i class="fas fa-spinner fa-spin text-2xl text-primary mr-2"></i>
                <p class="text-gray-500 text-sm">Memuat...</p>
            </div>
        </div>

        <div class="p-4 border-t border-gray-200 space-y-2">
            <button id="notif-read-all-btn-modal"
                class="w-full bg-gray-200 text-dark font-medium py-3 rounded-xl hover:bg-gray-300 transition btn-mark-read">
                <i class="fas fa-check-double mr-2"></i>Tandai Semua Dibaca
            </button>

            <button onclick="document.getElementById('notif-modal').classList.add('hidden')"
                class="w-full bg-gradient-to-r from-primary to-secondary text-white font-medium py-3 rounded-xl hover:from-secondary hover:to-accent transition shadow-sm">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    // Mobile menu toggle with icon animation
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.querySelector('.menu-icon');

    mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
        menuIcon.classList.toggle('active');

        // Change icon
        if (mobileMenu.classList.contains('hidden')) {
            menuIcon.classList.remove('fa-times');
            menuIcon.classList.add('fa-bars');
        } else {
            menuIcon.classList.remove('fa-bars');
            menuIcon.classList.add('fa-times');
        }
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
            mobileMenu.classList.add('hidden');
            menuIcon.classList.remove('active', 'fa-times');
            menuIcon.classList.add('fa-bars');
        }
    });

    // Dropdown toggle with chevron animation
    const dropdownToggle = document.getElementById('dropdown-toggle');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const chevronIcon = document.getElementById('chevron-icon');

    dropdownToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdownMenu.classList.toggle('hidden');
        chevronIcon.style.transform = dropdownMenu.classList.contains('hidden') ? 'rotate(0deg)' :
            'rotate(180deg)';
    });

    document.addEventListener('click', function(e) {
        if (!dropdownMenu.contains(e.target) && !dropdownToggle.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
            chevronIcon.style.transform = 'rotate(0deg)';
        }
    });

    // Notification Badge Update
    async function updateNotifBadge() {
        try {
            const res = await fetch('/notifications/unread-count');
            const data = await res.json();
            const unread = data.unread;

            const notifBadge = document.getElementById('notif-badge');
            const mobileNotifBadge = document.getElementById('mobile-notif-badge');

            if (unread > 0) {
                notifBadge.innerText = unread > 99 ? '99+' : unread;
                notifBadge.classList.remove('hidden');
                mobileNotifBadge.innerText = unread > 99 ? '99+' : unread;
                mobileNotifBadge.classList.remove('hidden');
            } else {
                notifBadge.classList.add('hidden');
                mobileNotifBadge.classList.add('hidden');
            }
        } catch (err) {
            console.error('Error updating badge:', err);
        }
    }

    // Notification Dropdown Toggle
    const notifToggle = document.getElementById('notif-toggle');
    const notifDropdown = document.getElementById('notif-dropdown');
    const notifList = document.getElementById('notif-list');

    notifToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        notifDropdown.classList.toggle('hidden');
        if (!notifDropdown.classList.contains('hidden')) {
            loadNotifications();
        }
    });

    document.addEventListener('click', function(e) {
        if (!notifDropdown.contains(e.target) && !notifToggle.contains(e.target)) {
            notifDropdown.classList.add('hidden');
        }
    });

    // Mobile Notification Button
    document.getElementById('mobile-notif-btn')?.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('notif-modal').classList.remove('hidden');
        loadAllNotifications();
    });

    // Load Notifications
    async function loadNotifications() {
        try {
            const res = await fetch('/notifications');
            const data = await res.json();

            notifList.innerHTML = '';

            if (data.length === 0) {
                notifList.innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-bell-slash text-3xl text-gray-300 mb-2"></i>
                        <p class="text-gray-500 text-sm">Tidak ada notifikasi</p>
                    </div>
                `;
                return;
            }

            updateNotifBadge();

            data.forEach(n => {
                const item = document.createElement('div');
                item.className =
                    `notif-item px-4 py-3 border-b cursor-pointer ${n.is_read ? 'bg-white' : 'bg-blue-50 hover:bg-blue-100'} hover:bg-gray-50`;

                item.innerHTML = `
                    <div class="flex justify-between items-start">
                        <div class="flex-1 mr-2">
                            <div class="font-medium text-dark text-sm">${n.title}</div>
                            <div class="text-gray-600 text-xs mt-1 line-clamp-2">${n.message}</div>
                        </div>
                        ${!n.is_read ? '<span class="w-2 h-2 bg-blue-600 rounded-full mt-1 unread-dot flex-shrink-0"></span>' : ''}
                    </div>
                `;

                item.addEventListener('click', async () => {
                    await fetch(`/notifications/${n.id}/read`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    loadNotifications();
                    updateNotifBadge();
                });

                notifList.appendChild(item);
            });

        } catch (err) {
            notifList.innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-circle text-3xl text-red-400 mb-2"></i>
                    <p class="text-red-500 text-sm">Gagal memuat notifikasi</p>
                </div>
            `;
        }
    }

    // Open Notification Modal
    document.getElementById('open-notif-modal')?.addEventListener('click', (e) => {
        e.preventDefault();
        notifDropdown.classList.add('hidden');
        document.getElementById('notif-modal').classList.remove('hidden');
        loadAllNotifications();
    });

    // Load All Notifications in Modal
    async function loadAllNotifications() {
        const modalList = document.getElementById('notif-modal-list');
        modalList.innerHTML = `
            <div class="flex items-center justify-center py-8">
                <i class="fas fa-spinner fa-spin text-2xl text-primary mr-2"></i>
                <p class="text-gray-500 text-sm">Memuat...</p>
            </div>
        `;

        try {
            const res = await fetch('/notifications/all');
            const data = await res.json();

            modalList.innerHTML = '';

            if (data.length === 0) {
                modalList.innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-bell-slash text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Tidak ada notifikasi</p>
                    </div>
                `;
                return;
            }

            data.forEach(n => {
                const item = document.createElement('div');
                item.className = `notif-item border-b py-3 px-2 ${n.is_read ? 'bg-white' : 'bg-blue-50'}`;
                item.innerHTML = `
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="font-semibold text-dark text-sm">${n.title}</div>
                            <div class="text-sm text-gray-600 mt-1">${n.message}</div>
                        </div>
                        ${!n.is_read ? '<span class="w-2 h-2 bg-blue-600 rounded-full mt-1 unread-dot flex-shrink-0"></span>' : ''}
                    </div>
                `;
                modalList.appendChild(item);
            });
        } catch (err) {
            modalList.innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-circle text-4xl text-red-400 mb-3"></i>
                    <p class="text-red-500">Gagal memuat notifikasi</p>
                </div>
            `;
        }
    }

    // Mark All as Read - Dropdown
    document.getElementById('notif-read-all-btn')?.addEventListener('click', async () => {
        try {
            await fetch('/notifications/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            loadNotifications();
            updateNotifBadge();
        } catch (err) {
            console.error('Error marking all as read:', err);
        }
    });

    // Mark All as Read - Modal
    document.getElementById('notif-read-all-btn-modal')?.addEventListener('click', async () => {
        try {
            await fetch('/notifications/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            loadAllNotifications();
            updateNotifBadge();
        } catch (err) {
            console.error('Error marking all as read:', err);
        }
    });

    // Initial Load
    loadNotifications();
    updateNotifBadge();

    // Auto refresh every 30 seconds
    setInterval(() => {
        updateNotifBadge();
    }, 30000);
</script>
