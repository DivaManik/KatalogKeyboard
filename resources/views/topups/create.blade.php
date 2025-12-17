@extends('layouts.app')

@section('title', 'Request Top-Up Saldo')

@section('content')
    <style>
        .topup-form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .form-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .form-card-header {
            background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        .form-card-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }
        .form-card-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            font-size: 0.875rem;
        }
        .form-card-body {
            padding: 2rem;
        }
        .balance-display {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .balance-label {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.25rem;
        }
        .balance-amount {
            font-size: 1.75rem;
            font-weight: 700;
            color: #10b981;
        }
        .info-box {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
        }
        .info-box-title {
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .info-box-content {
            font-size: 0.875rem;
            color: #1e40af;
            margin: 0;
        }
        .info-box-content li {
            margin-bottom: 0.25rem;
        }
        .upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #f9fafb;
        }
        .upload-area:hover {
            border-color: #0066FF;
            background: #f0f7ff;
        }
        .upload-area.has-file {
            border-color: #10b981;
            background: #f0fdf4;
        }
        .upload-icon {
            font-size: 3rem;
            color: #9ca3af;
            margin-bottom: 0.5rem;
        }
        .upload-area.has-file .upload-icon {
            color: #10b981;
        }
        .upload-text {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.25rem;
        }
        .upload-subtext {
            font-size: 0.875rem;
            color: #6b7280;
        }
        .preview-image {
            max-width: 100%;
            max-height: 300px;
            margin-top: 1rem;
            border-radius: 6px;
            display: none;
        }
        .preview-image.show {
            display: block;
        }
        .remove-image-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 32px;
            height: 32px;
            background: #dc3545;
            color: white;
            border: 2px solid white;
            border-radius: 50%;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 2px 10px rgba(220, 53, 69, 0.5);
            transition: all 0.3s;
            z-index: 10;
        }
        .remove-image-btn:hover {
            background: #c82333;
            transform: scale(1.1);
        }
        .remove-image-btn.show {
            display: flex;
        }
        .preview-container {
            position: relative;
        }
        .amount-input {
            font-size: 1.25rem;
            font-weight: 600;
            text-align: center;
            padding: 0.75rem;
        }
        .quick-amount-btns {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        .quick-amount-btn {
            padding: 0.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            background: white;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.2s;
        }
        .quick-amount-btn:hover {
            border-color: #0066FF;
            color: #0066FF;
            background: #f0f7ff;
        }
    </style>

    <div class="topup-form-container">
        <a href="{{ route('topups.index') }}" class="btn btn-link p-0 mb-3">
            <i class="bi bi-arrow-left"></i> Kembali ke Riwayat Top-Up
        </a>

        <div class="form-card">
            <div class="form-card-header">
                <h1>
                    <i class="bi bi-wallet2"></i> Request Top-Up Saldo
                </h1>
                <p>Isi saldo untuk mulai berbelanja keyboard impianmu</p>
            </div>

            <div class="form-card-body">
                <!-- Current Balance -->
                <div class="balance-display">
                    <div class="balance-label">Saldo Saat Ini</div>
                    <div class="balance-amount">Rp{{ number_format(auth()->user()->balance, 0, ',', '.') }}</div>
                </div>

                <!-- Information Box -->
                <div class="info-box">
                    <div class="info-box-title">
                        <i class="bi bi-info-circle-fill"></i> Informasi Top-Up
                    </div>
                    <ul class="info-box-content">
                        <li>Minimal top-up: <strong>Rp10.000</strong></li>
                        <li>Maksimal top-up: <strong>Rp100.000.000</strong></li>
                        <li>Upload bukti transfer yang jelas sesuai dengan jumlah top up (JPG, PNG, max 2MB)</li>
                        <li>Proses verifikasi: <strong>1-24 jam</strong></li>
                    </ul>
                </div>

                <!-- Top-Up Form -->
                <form action="{{ route('topups.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Amount Input -->
                    <div class="form-group">
                        <label for="amount">Jumlah Top-Up</label>
                        <input type="number"
                               name="amount"
                               id="amount"
                               class="form-control amount-input @error('amount') is-invalid @enderror"
                               placeholder="0"
                               value="{{ old('amount') }}"
                               min="10000"
                               max="100000000"
                               required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Quick Amount Buttons -->
                        <div class="quick-amount-btns">
                            <button type="button" class="quick-amount-btn" onclick="setAmount(50000)">Rp50.000</button>
                            <button type="button" class="quick-amount-btn" onclick="setAmount(100000)">Rp100.000</button>
                            <button type="button" class="quick-amount-btn" onclick="setAmount(200000)">Rp200.000</button>
                            <button type="button" class="quick-amount-btn" onclick="setAmount(500000)">Rp500.000</button>
                            <button type="button" class="quick-amount-btn" onclick="setAmount(1000000)">Rp1.000.000</button>
                            <button type="button" class="quick-amount-btn" onclick="setAmount(2000000)">Rp2.000.000</button>
                        </div>
                    </div>

                    <!-- Proof Image Upload -->
                    <div class="form-group">
                        <label>Bukti Transfer</label>
                        <div class="upload-area" id="uploadArea" onclick="document.getElementById('proof_image').click()">
                            <i class="bi bi-cloud-upload upload-icon" id="uploadIcon"></i>
                            <div class="upload-text" id="uploadText">Klik untuk upload bukti transfer</div>
                            <div class="upload-subtext">JPG, PNG (Max 2MB)</div>
                            <input type="file"
                                   name="proof_image"
                                   id="proof_image"
                                   accept="image/jpeg,image/png,image/jpg"
                                   class="d-none @error('proof_image') is-invalid @enderror"
                                   required>
                            <div class="preview-container">
                                <img id="previewImage" class="preview-image" alt="Preview">
                                <button type="button" id="removeImageBtn" class="remove-image-btn" onclick="removeImage(event)">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                        @error('proof_image')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i class="bi bi-send-fill"></i> Kirim Permintaan Top-Up
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Quick amount setter
        function setAmount(amount) {
            document.getElementById('amount').value = amount;
        }

        // Image preview
        document.getElementById('proof_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const uploadArea = document.getElementById('uploadArea');
            const uploadIcon = document.getElementById('uploadIcon');
            const uploadText = document.getElementById('uploadText');
            const previewImage = document.getElementById('previewImage');
            const removeBtn = document.getElementById('removeImageBtn');

            if (file) {
                // Update UI
                uploadArea.classList.add('has-file');
                uploadIcon.className = 'bi bi-check-circle-fill upload-icon';
                uploadText.textContent = file.name;

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.add('show');
                    removeBtn.classList.add('show');
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove image function
        function removeImage(event) {
            // Prevent event from bubbling to upload area
            event.stopPropagation();

            const fileInput = document.getElementById('proof_image');
            const uploadArea = document.getElementById('uploadArea');
            const uploadIcon = document.getElementById('uploadIcon');
            const uploadText = document.getElementById('uploadText');
            const previewImage = document.getElementById('previewImage');
            const removeBtn = document.getElementById('removeImageBtn');

            // Reset file input
            fileInput.value = '';

            // Reset UI
            uploadArea.classList.remove('has-file');
            uploadIcon.className = 'bi bi-cloud-upload upload-icon';
            uploadText.textContent = 'Klik untuk upload bukti transfer';
            previewImage.classList.remove('show');
            previewImage.src = '';
            removeBtn.classList.remove('show');
        }

        // Format amount input on blur
        document.getElementById('amount').addEventListener('blur', function() {
            const value = parseInt(this.value) || 0;
            if (value < 10000) {
                this.value = 10000;
            } else if (value > 100000000) {
                this.value = 100000000;
            }
        });
    </script>
@endpush
