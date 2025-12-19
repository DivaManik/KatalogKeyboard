<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'KKB | Katalog Keyboard Bagus')</title>
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
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }
        .nav-link-custom:hover {
            color: #0066FF !important;
            background: rgba(0, 102, 255, 0.05);
        }
        .nav-link-custom.active {
            color: #0066FF !important;
            background: rgba(0, 102, 255, 0.1);
            font-weight: 600;
        }
        .nav-link-custom.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: #0066FF;
            border-radius: 3px 3px 0 0;
        }
        .btn-login {
            background: #0066FF;
            color: white !important;
            border-radius: 50px;
            padding: 10px 28px;
            font-weight: 600;
            border: 2px solid #0066FF;
            box-shadow: 0 2px 8px rgba(0, 102, 255, 0.2);
            transition: all 0.3s ease;
            display: inline-block;
        }
        .btn-login:hover {
            background: #0052cc;
            border-color: #0052cc;
            box-shadow: 0 4px 12px rgba(0, 102, 255, 0.3);
            transform: translateY(-1px);
        }
        .btn-login.active {
            background: #0052cc;
            border-color: #0052cc;
            box-shadow: 0 4px 12px rgba(0, 102, 255, 0.4);
        }
        @stack('styles')
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom @yield('navbar-class')">
        <div class="container">
            <a class="navbar-brand navbar-brand-custom" href="{{ route('home') }}">
                <i class="bi bi-keyboard-fill"></i> KKB
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ml-auto align-items-center">
                    <a class="nav-link nav-link-custom @if(in_array(Route::currentRouteName(), ['search.view', 'search.results'])) active @endif"
                       href="{{ route('search.view') }}">
                        <i class="bi bi-search"></i> Katalog
                    </a>
                    <a class="nav-link btn-login ml-3 @if(in_array(Route::currentRouteName(), ['login', 'register'])) active @endif"
                       href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
