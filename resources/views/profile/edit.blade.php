@extends('layouts.app')

@section('title', 'Pengaturan Profile')

@section('content')
    <style>
        .profile-container {
            max-width: 900px;
            margin: 0 auto;
        }
        .profile-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .profile-header {
            background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .profile-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
        }
        .profile-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
        }
        .profile-tabs {
            display: flex;
            border-bottom: 2px solid #f3f4f6;
            background: #f8f9fa;
        }
        .profile-tab {
            flex: 1;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            color: #6b7280;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        .profile-tab:hover {
            color: #0066FF;
            background: white;
        }
        .profile-tab.active {
            color: #0066FF;
            background: white;
            border-bottom-color: #0066FF;
        }
        .profile-tab i {
            margin-right: 0.5rem;
        }
        .tab-content-area {
            padding: 2rem;
        }
        .tab-pane {
            display: none;
        }
        .tab-pane.active {
            display: block;
        }
        .avatar-upload {
            text-align: center;
            margin-bottom: 2rem;
        }
        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1rem;
            border: 4px solid #e5e7eb;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .avatar-upload-btn {
            position: relative;
            display: inline-block;
        }
        .avatar-upload-btn input[type="file"] {
            display: none;
        }
        .info-box {
            background: #f0f9ff;
            border-left: 4px solid #3b82f6;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
        }
        .info-box-content {
            font-size: 0.875rem;
            color: #1e40af;
            margin: 0;
        }
        .form-group label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        .form-control:focus {
            border-color: #0066FF;
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 255, 0.25);
        }
        .required-badge {
            background: #fef3c7;
            color: #92400e;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-weight: 600;
        }
    </style>

    <div class="profile-container">
        <div class="profile-card">
            <!-- Header -->
            <div class="profile-header">
                <h1>
                    <i class="bi bi-person-circle"></i> Pengaturan Profile
                </h1>
                <p>Kelola informasi profile dan keamanan akun Anda</p>
            </div>

            <!-- Tabs -->
            <div class="profile-tabs">
                <div class="profile-tab active" onclick="switchTab('profile-info')">
                    <i class="bi bi-person-badge"></i> Informasi Profile
                </div>
                <div class="profile-tab" onclick="switchTab('change-password')">
                    <i class="bi bi-shield-lock"></i> Ubah Password
                </div>
            </div>

            <!-- Tab Content -->
            <div class="tab-content-area">
                <!-- Profile Info Tab -->
                <div id="profile-info" class="tab-pane active">
                    <div class="info-box">
                        <p class="info-box-content">
                            <i class="bi bi-info-circle"></i> <strong>Penting:</strong> Alamat dan nomor telepon diperlukan untuk melakukan pemesanan keyboard.
                        </p>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Avatar Upload -->
                        <div class="avatar-upload">
                            <img src="{{ auth()->user()->foto ? asset('storage/' . auth()->user()->foto) : 'https://via.placeholder.com/120' }}"
                                 alt="Avatar"
                                 class="avatar-preview"
                                 id="avatarPreview">
                            <div class="avatar-upload-btn">
                                <label for="foto" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-camera"></i> Ganti Foto Profile
                                </label>
                                <input type="file" name="foto" id="foto" accept="image/*">
                            </div>
                            <div class="small text-muted mt-2">JPG, PNG (Max 2MB)</div>
                            @error('foto')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email (Read Only) -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email"
                                   class="form-control"
                                   value="{{ auth()->user()->email }}"
                                   readonly
                                   disabled>
                            <small class="text-muted">Email tidak dapat diubah</small>
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label for="phone">
                                Nomor Telepon
                                @if(!auth()->user()->phone)
                                    <span class="required-badge">
                                        <i class="bi bi-exclamation-circle"></i> Diperlukan untuk Order
                                    </span>
                                @endif
                            </label>
                            <input type="text"
                                   name="phone"
                                   id="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', auth()->user()->phone) }}"
                                   placeholder="Contoh: 081234567890">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label for="address">
                                Alamat Lengkap
                                @if(!auth()->user()->address)
                                    <span class="required-badge">
                                        <i class="bi bi-exclamation-circle"></i> Diperlukan untuk Order
                                    </span>
                                @endif
                            </label>
                            <textarea name="address"
                                      id="address"
                                      class="form-control @error('address') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Masukkan alamat lengkap untuk pengiriman...">{{ old('address', auth()->user()->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                            <i class="bi bi-check-circle"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>

                <!-- Change Password Tab -->
                <div id="change-password" class="tab-pane">
                    <div class="info-box">
                        <p class="info-box-content">
                            <i class="bi bi-shield-check"></i> Gunakan password yang kuat dengan kombinasi huruf, angka, dan simbol untuk keamanan akun Anda.
                        </p>
                    </div>

                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Current Password -->
                        <div class="form-group">
                            <label for="current_password">Password Saat Ini <span class="text-danger">*</span></label>
                            <input type="password"
                                   name="current_password"
                                   id="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="form-group">
                            <label for="new_password">Password Baru <span class="text-danger">*</span></label>
                            <input type="password"
                                   name="new_password"
                                   id="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror"
                                   required>
                            <small class="text-muted">Minimal 8 karakter</small>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div class="form-group">
                            <label for="new_password_confirmation">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <input type="password"
                                   name="new_password_confirmation"
                                   id="new_password_confirmation"
                                   class="form-control"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                            <i class="bi bi-shield-check"></i> Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Tab Switching
        function switchTab(tabId) {
            // Hide all tabs
            document.querySelectorAll('.tab-pane').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.profile-tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Show selected tab
            document.getElementById(tabId).classList.add('active');
            event.target.closest('.profile-tab').classList.add('active');
        }

        // Avatar Preview
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
