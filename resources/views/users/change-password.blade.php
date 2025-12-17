@extends('layouts.app')

@section('title', 'Ganti Password')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first() }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 d-flex align-items-center">
                    <span class="badge badge-primary mr-2">
                        <i class="bi bi-shield-lock"></i>
                    </span>
                    <h1 class="h5 mb-0">Ganti Password</h1>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        Silakan isi form berikut untuk mengganti password akun Anda.
                    </p>

                    <form method="POST" action="{{ route('profile.password.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="current_password">Password Saat Ini</label>
                            <input type="password"
                                   id="current_password"
                                   name="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   placeholder="Masukkan password sekarang"
                                   required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password">Password Baru</label>
                            <input type="password"
                                   id="new_password"
                                   name="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror"
                                   placeholder="Masukkan password baru"
                                   required>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password"
                                   id="new_password_confirmation"
                                   name="new_password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password baru"
                                   required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
