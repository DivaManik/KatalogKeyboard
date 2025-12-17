<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Masuk | KKB</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: #ffffff;
        }
        .auth-wrapper {
            max-width: 420px;
            width: 100%;
        }

        .auth-card {
            border-radius: 18px;
        }

        .auth-input {
            border-radius: 14px;
            padding: 1rem 1.25rem;
            font-size: 1rem;
        }

        .auth-button {
            border-radius: 999px;
            font-weight: 600;
            letter-spacing: 0.3px;
            padding: 0.85rem 1rem;
            background: #0066FF;
            border: none;
        }

        .auth-button:hover {
            background: #0052cc;
        }

        .link-text {
            color: #0066FF;
            text-decoration: none;
        }

        .link-text:hover {
            color: #0052cc;
            text-decoration: underline;
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
        .btn-login.active {
            background: #0052cc;
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
                    <a class="nav-link nav-link-custom btn-login ml-3 active" href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="d-flex align-items-center justify-content-center min-vh-100 py-5">
        <div class="container" style="max-width: 500px;">
            @if (session('status'))
                @php $statusType = session('status_type', 'success'); @endphp
                <div class="alert alert-{{ $statusType }} alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="auth-wrapper mx-auto">
                <div class="card shadow-lg border-0 auth-card">
                    <div class="card-header bg-white border-0 text-center">
                        <h1 class="h3 mb-0 font-weight-bold text-dark">Login</h1>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('login.attempt') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email" class="sr-only">E-mail</label>
                                <input id="email"
                                       type="email"
                                       class="form-control form-control-lg auth-input @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="Masukan E-mail"
                                       required
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input id="password"
                                       type="password"
                                       class="form-control form-control-lg auth-input @error('password') is-invalid @enderror"
                                       name="password"
                                       placeholder="Masukan Password"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block auth-button">
                                Login
                            </button>

                            <div class="text-center mt-3">
                                <span class="text-muted">Belum punya akun?</span>
                                <a href="{{ route('register') }}" class="link-text font-weight-bold">Daftar di sini</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
