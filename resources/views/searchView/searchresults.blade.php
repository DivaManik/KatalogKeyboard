<!doctype html>
<html lang="id">
<head>
    <title>Hasil Pencarian: {{ $text_input }} | KKB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: #ffffff;
        }
        .card-keyboard:hover {
            transform: translateY(-2px);
            transition: 0.2s;
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
        .btn-login {
            background: #0066FF;
            color: white !important;
            border-radius: 50px;
            padding: 8px 24px;
            font-weight: 600;
        }
        .btn-login:hover {
            background: #0052cc;
        }
        .search-box-compact {
            display: flex;
            align-items: center;
            background: #ffffff;
            border-radius: 50px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 6px 6px 6px 20px;
            border: 1px solid #e5e7eb;
        }
        .search-box-compact:focus-within {
            border-color: #0066FF;
            box-shadow: 0 4px 20px rgba(0, 102, 255, 0.15);
        }
        .search-icon {
            color: #9ca3af;
            font-size: 1.2rem;
            margin-right: 12px;
        }
        .search-input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 1rem;
            color: #374151;
            background: transparent;
            padding: 10px 0;
        }
        .search-input::placeholder {
            color: #9ca3af;
        }
        .search-btn {
            background: #0066FF;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 24px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .search-btn:hover {
            background: #0052cc;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand navbar-brand-custom" href="{{ route('home') }}">
                <i class="bi bi-keyboard-fill"></i> KKB
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ml-auto align-items-center">
                    <a class="nav-link nav-link-custom" href="{{ route('search.view') }}">Katalog</a>
                    <a class="nav-link nav-link-custom btn-login ml-3" href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container py-5">
        <!-- Search Form -->
        <div class="mb-5">
            <form action="{{ route('search.results') }}" method="GET">
                <div class="search-box-compact">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" name="search" class="search-input"
                           placeholder="Cari keyboard, switch, atau brand..."
                           value="{{ $text_input }}">
                    <button type="submit" class="search-btn">Cari</button>
                </div>
            </form>
        </div>

        <div class="mb-4">
            <h2>Hasil Pencarian: "{{ $text_input }}"</h2>
            <p class="text-muted">Ditemukan {{ $keyboards->count() }} keyboard</p>
        </div>

        @if($keyboards->count() > 0)
            <div class="row">
                @foreach($keyboards as $keyboard)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 card-keyboard">
                        @php
                            $fallbackImage = asset('images/No_Image_available.svg');
                            $cardImage = $keyboard->image_path ?? $fallbackImage;
                        @endphp
                        <img src="{{ $cardImage }}" class="card-img-top" alt="{{ $keyboard->name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $keyboard->name }}</h5>
                            <p class="text-muted small mb-2">{{ $keyboard->brand }} &middot; {{ $keyboard->layout ?? 'N/A' }}</p>
                            <p class="card-text">{{ Str::limit($keyboard->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge badge-primary">{{ ucfirst($keyboard->connection) }}</span>
                                @if($keyboard->price)
                                    <strong class="text-success">Rp {{ number_format($keyboard->price, 0, ',', '.') }}</strong>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Tidak ada keyboard yang ditemukan untuk "{{ $text_input }}".
            </div>
        @endif

        <div class="mt-5 text-center">
            <p class="text-muted mb-3">Ingin mengakses fitur lengkap dan mengelola keyboard?</p>
            <a href="{{ route('login') }}" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right"></i> Login Sekarang
            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
