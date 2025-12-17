<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KKB | Katalog Keyboard Bagus')</title>
    <!-- Bootstrap Offline -->
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> -->
     <!-- Bootstrap Online -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
     <!-- SweetAlert2 -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: #f7f9fc;
        }
        .product-description {
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .product-description.pre-line {
            white-space: pre-line;
        }
        .user-menu-toggle {
            font-size: 2rem;
            line-height: 1;
            color: #374151 !important;
        }
        .user-menu-toggle:hover {
            color: #0066FF !important;
        }
        .user-profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e5e7eb;
            transition: border-color 0.3s;
        }
        .user-profile-avatar:hover {
            border-color: #0066FF;
        }
        .user-dropdown-menu {
            min-width: 230px;
            border-radius: 18px;
            overflow: hidden;
        }
        .user-summary {
            display: flex;
            padding: 1rem;
            border-bottom: 1px solid #f0f2f5;
        }
        .user-summary img {
            width: 54px;
            height: 54px;
            border-radius: 10px;
            object-fit: cover;
        }
        .user-summary .user-meta {
            margin-left: 0.75rem;
        }
        .user-summary .user-meta .user-time {
            font-size: 0.875rem;
        }
        .dropdown-item i {
            margin-right: 0.5rem;
        }
        .navbar-brand.user-name {
            font-size: 1rem;
            font-weight: 600;
            color: #1a1a2e !important;
        }
        .navbar-custom {
            background: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
            padding: 1rem 0;
        }
        .navbar-brand-custom {
            font-weight: 700;
            font-size: 1.5rem;
            color: #1a1a2e !important;
        }
        .nav-link-custom {
            color: #374151 !important;
            font-weight: 500;
            margin-left: 1.5rem;
        }
        .nav-link-custom:hover {
            color: #0066FF !important;
        }
        .nav-link-custom.active {
            color: #0066FF !important;
            font-weight: 600;
        }

        /* Notification Styles */
        .notification-bell-toggle {
            font-size: 1.5rem;
            color: #374151 !important;
            transition: color 0.3s;
        }
        .notification-bell-toggle:hover {
            color: #0066FF !important;
        }
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background: #dc3545;
            color: white;
            border-radius: 10px;
            padding: 2px 6px;
            font-size: 0.65rem;
            font-weight: 700;
            min-width: 18px;
            text-align: center;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .notification-dropdown {
            min-width: 380px;
            max-width: 400px;
            border-radius: 12px;
            overflow: hidden;
            border: none;
            margin-top: 0.5rem;
        }
        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #f0f2f5;
            background: #f8f9fa;
        }
        .notification-header h6 {
            font-weight: 700;
            color: #1a1a2e;
        }
        .notification-list {
            max-height: 400px;
            overflow-y: auto;
        }
        .notification-item {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid #f0f2f5;
            cursor: pointer;
            transition: background 0.2s;
        }
        .notification-item:hover {
            background: #f8f9fa;
        }
        .notification-item.unread {
            background: #e3f2fd;
        }
        .notification-item.unread:hover {
            background: #bbdefb;
        }
        .notification-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }
        .notification-icon.order {
            background: #e3f2fd;
            color: #1976d2;
        }
        .notification-icon.topup {
            background: #e8f5e9;
            color: #388e3c;
        }
        .notification-title {
            font-weight: 600;
            font-size: 0.875rem;
            color: #1a1a2e;
            margin-bottom: 0.25rem;
        }
        .notification-message {
            font-size: 0.8rem;
            color: #6b7280;
            line-height: 1.4;
        }
        .notification-time {
            font-size: 0.7rem;
            color: #9ca3af;
            margin-top: 0.25rem;
        }
        .notification-footer {
            padding: 0.5rem;
            background: #f8f9fa;
            border-top: 1px solid #f0f2f5;
        }
        .notification-empty {
            padding: 2rem 1rem;
            text-align: center;
            color: #9ca3af;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            {{-- Logo --}}
            <a class="navbar-brand navbar-brand-custom" href="{{ route('home') }}">
                <i class="bi bi-keyboard-fill"></i> KKB
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- Menu Links (Left Side) --}}
                <div class="navbar-nav">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    <a class="nav-link nav-link-custom {{ request()->routeIs('keyboards.index') ? 'active' : '' }}" href="{{ route('keyboards.index') }}">Daftar Keyboard</a>

                    @if(auth()->check() && auth()->user()->isGuest())
                        {{-- Menu khusus Guest --}}
                        <a class="nav-link nav-link-custom {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                            <i class="bi bi-bag-check"></i> Pesanan Saya
                        </a>
                        <a class="nav-link nav-link-custom {{ request()->routeIs('topups.*') ? 'active' : '' }}" href="{{ route('topups.index') }}">
                            <i class="bi bi-wallet2"></i> Top-Up
                        </a>
                    @endif

                    @if(auth()->check() && auth()->user()->isAdmin())
                        {{-- Menu khusus Admin --}}
                        <a class="nav-link nav-link-custom {{ request()->routeIs('orders.admin') ? 'active' : '' }}" href="{{ route('orders.admin') }}">
                            <i class="bi bi-box-seam"></i> Kelola Pesanan
                        </a>
                        <a class="nav-link nav-link-custom {{ request()->routeIs('topups.admin') ? 'active' : '' }}" href="{{ route('topups.admin') }}">
                            <i class="bi bi-cash-stack"></i> Keuangan
                        </a>
                        <a class="nav-link nav-link-custom {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <i class="bi bi-people-fill"></i> Daftar User
                        </a>
                    @endif

                </div>

                {{-- User Profile (Right Side) --}}
                <div class="navbar-nav ml-auto d-flex align-items-center">
                    {{-- Notifications Bell --}}
                    <div class="dropdown mr-3">
                        @if(auth()->check() && auth()->user()->isGuest())
                        <button class="btn btn-link p-0 notification-bell-toggle position-relative" type="button" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-bell-fill"></i>
                            <span class="notification-badge" id="notificationBadge" style="display: none;">0</span>
                        </button>
                        @endif
                        
                        <div class="dropdown-menu dropdown-menu-right notification-dropdown shadow" aria-labelledby="notificationDropdown">
                            <div class="notification-header">
                                <h6 class="mb-0">Notifikasi</h6>
                                <button class="btn btn-link btn-sm p-0 text-primary" id="markAllReadBtn">
                                    <small>Tandai semua dibaca</small>
                                </button>
                            </div>
                            <div class="notification-list" id="notificationList">
                                <div class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox"></i>
                                    <p class="mb-0 small">Memuat notifikasi...</p>
                                </div>
                            </div>
                            <div class="notification-footer">
                                <a href="{{ route('notifications.index') }}" class="btn btn-link btn-sm btn-block">
                                    Lihat Semua Notifikasi
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- User Profile --}}
                    <div class="dropdown d-flex align-items-center">
                        <button class="btn btn-link p-0 user-menu-toggle d-flex align-items-center" type="button" id="userMenuDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(Auth::user()->foto)
                                <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="{{ Auth::user()->name }}" class="user-profile-avatar">
                            @else
                                <i class="bi bi-person-circle"></i>
                            @endif
                        </button>
                        <div class="dropdown-menu dropdown-menu-right user-dropdown-menu shadow" aria-labelledby="userMenuDropdown">
                            <div class="user-summary">
                                <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : 'https://via.placeholder.com/50' }}" alt="User photo">
                                <div class="user-meta">
                                    <div class="font-weight-bold text-capitalize">{{ Auth::user()->name }}</div>
                                    <div class="text-muted user-time">
                                        <i class="bi bi-clock mr-1"></i>{{ now()->format('H:i') }}
                                    </div>
                                </div>
                            </div>
                            @if(auth()->user()->isGuest())
                                <a href="{{ route('topups.index') }}" class="dropdown-item bg-light border-top border-bottom">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small text-muted">
                                            <i class="bi bi-wallet2"></i> Saldo:
                                        </span>
                                        <span class="font-weight-bold text-success">
                                            Rp{{ number_format(Auth::user()->balance, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                                        <i class="bi bi-plus-circle"></i> Klik untuk Top-Up
                                    </small>
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-gear"></i>Settings
                            </a>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-right"></i>Logout
                            </a>
                        </div>
                        <span class="navbar-brand user-name ml-2 mb-0">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <script src="{{ asset('js/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Show SweetAlert for Flash Messages --}}
    @if (session('status'))
        <script>
            Swal.fire({
                icon: '{{ session("status_type") === "danger" ? "error" : session("status_type", "success") }}',
                title: '{{ session("status_type") === "success" ? "Berhasil!" : (session("status_type") === "danger" ? "Gagal!" : "Informasi") }}',
                text: '{{ session("status") }}',
                confirmButtonColor: '#0066FF',
                timer: 3000,
                timerProgressBar: true,
            });
        </script>
    @endif

    <script>
        window.initDataTable = function (selector, extraOptions, numberingColumnIndex) {
            numberingColumnIndex = typeof numberingColumnIndex === 'number' ? numberingColumnIndex : 0;
            if (typeof window.jQuery === 'undefined' || typeof $.fn.DataTable !== 'function') {
                return null;
            }

            var element = document.querySelector(selector);
            if (!element) {
                return null;
            }

            var defaultOptions = {
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                },
            };

            var options = $.extend(true, {}, defaultOptions, extraOptions || {});
            var table = $(selector).DataTable(options);

            if (numberingColumnIndex !== null) {
                table.on('order.dt search.dt draw.dt', function () {
                    table
                        .column(numberingColumnIndex, { search: 'applied', order: 'applied' })
                        .nodes()
                        .each(function (cell, i) {
                            cell.innerHTML = i + 1;
                        });
                }).draw();
            }

            return table;
        };
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var enableRowNavigation = false;
            if (!enableRowNavigation) {
                return;
            }

            document.addEventListener('click', function (event) {
                if (event.target.closest('[data-row-ignore]')) {
                    return;
                }

                var row = event.target.closest('[data-row-link]');
                if (row) {
                    var href = row.getAttribute('data-row-link');
                    if (href) {
                        window.location.href = href;
                    }
                }
            });
        });
    </script>

    {{-- Notification Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load notifications when page loads
            loadNotifications();

            // Reload notifications every 30 seconds
            setInterval(loadNotifications, 30000);

            // Load notifications when dropdown is opened
            $('#notificationDropdown').on('show.bs.dropdown', function () {
                loadNotifications();
            });

            // Mark all as read button
            $('#markAllReadBtn').on('click', function(e) {
                e.preventDefault();
                markAllAsRead();
            });
        });

        function loadNotifications() {
            fetch('{{ route("notifications.get") }}')
                .then(response => response.json())
                .then(data => {
                    updateNotificationBadge(data.unread_count);
                    renderNotifications(data.notifications);
                })
                .catch(error => {
                    console.error('Error loading notifications:', error);
                });
        }

        function updateNotificationBadge(count) {
            const badge = document.getElementById('notificationBadge');
            if (count > 0) {
                badge.textContent = count > 99 ? '99+' : count;
                badge.style.display = 'inline-block';
            } else {
                badge.style.display = 'none';
            }
        }

        function renderNotifications(notifications) {
            const container = document.getElementById('notificationList');

            if (notifications.length === 0) {
                container.innerHTML = `
                    <div class="notification-empty">
                        <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                        <p class="mb-0 mt-2">Tidak ada notifikasi</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = notifications.map(notification => {
                const isUnread = !notification.is_read;
                const iconClass = notification.type.includes('order') ? 'order' : 'topup';
                const icon = notification.type.includes('order') ? 'bi-box-seam' : 'bi-cash-stack';
                const timeAgo = formatTimeAgo(notification.created_at);

                return `
                    <div class="notification-item ${isUnread ? 'unread' : ''}"
                         onclick="markNotificationAsRead(${notification.id})"
                         data-notification-id="${notification.id}">
                        <div class="d-flex">
                            <div class="notification-icon ${iconClass}">
                                <i class="bi ${icon}"></i>
                            </div>
                            <div class="flex-grow-1 ml-3">
                                <div class="notification-title">${notification.title}</div>
                                <div class="notification-message">${notification.message}</div>
                                <div class="notification-time">${timeAgo}</div>
                            </div>
                            ${isUnread ? '<div class="ml-2"><span class="badge badge-primary badge-pill">Baru</span></div>' : ''}
                        </div>
                    </div>
                `;
            }).join('');
        }

        function markNotificationAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadNotifications();
                }
            })
            .catch(error => {
                console.error('Error marking notification as read:', error);
            });
        }

        function markAllAsRead() {
            fetch('{{ route("notifications.readAll") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadNotifications();
                }
            })
            .catch(error => {
                console.error('Error marking all as read:', error);
            });
        }

        function formatTimeAgo(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const seconds = Math.floor((now - date) / 1000);

            if (seconds < 60) return 'Baru saja';
            if (seconds < 3600) return Math.floor(seconds / 60) + ' menit yang lalu';
            if (seconds < 86400) return Math.floor(seconds / 3600) + ' jam yang lalu';
            if (seconds < 604800) return Math.floor(seconds / 86400) + ' hari yang lalu';

            return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
        }
    </script>

    @stack('scripts')
</body>
</html>
