<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'KKB | Katalog Keyboard Bagus')</title>
    <!-- Bootstrap Offline -->
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> -->
     <!-- Bootstrap Online -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
                <div class="navbar-nav ml-auto">
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
        @if (session('status'))
            @php $statusType = session('status_type', 'success'); @endphp
            <div class="alert alert-{{ $statusType }} alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="{{ asset('js/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
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
    @stack('scripts')
</body>
</html>
