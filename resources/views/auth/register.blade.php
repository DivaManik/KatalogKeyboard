@extends('layouts.guest')

@section('title', 'Daftar | KKB')

@push('styles')
<style>
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
</style>
@endpush

@section('content')
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
                    <h1 class="h3 mb-0 font-weight-bold text-dark">Daftar Akun Baru</h1>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register.attempt') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="sr-only">Nama</label>
                            <input id="name"
                                   type="text"
                                   class="form-control form-control-lg auth-input @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Masukan Nama Lengkap"
                                   required
                                   autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="sr-only">E-mail</label>
                            <input id="email"
                                   type="email"
                                   class="form-control form-control-lg auth-input @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Masukan E-mail"
                                   required>
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

                        <div class="form-group">
                            <label for="password_confirmation" class="sr-only">Konfirmasi Password</label>
                            <input id="password_confirmation"
                                   type="password"
                                   class="form-control form-control-lg auth-input"
                                   name="password_confirmation"
                                   placeholder="Konfirmasi Password"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block auth-button">
                            Daftar
                        </button>

                        <div class="text-center mt-3">
                            <span class="text-muted">Sudah punya akun?</span>
                            <a href="{{ route('login') }}" class="link-text font-weight-bold">Login di sini</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
