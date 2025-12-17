@extends('layouts.app')

@section('title', 'Riwayat Top-Up')

@section('content')
    <style>
        .topup-header-card {
            background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
            border-radius: 8px;
            color: white;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 102, 255, 0.2);
        }
        .topup-header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .balance-section {
            flex: 1;
        }
        .balance-label {
            font-size: 0.875rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }
        .balance-amount {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
        }
        .topup-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 1rem;
            transition: all 0.3s;
        }
        .topup-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }
        .topup-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f3f4f6;
        }
        .topup-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a2e;
        }
        .topup-card-body {
            padding: 1.5rem;
        }
        .topup-info-row {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            font-size: 0.875rem;
        }
        .topup-info-row:last-child {
            margin-bottom: 0;
        }
        .topup-info-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            font-size: 1rem;
        }
        .topup-info-content {
            flex: 1;
        }
        .topup-info-label {
            color: #6b7280;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .topup-info-value {
            color: #1a1a2e;
            font-weight: 600;
        }
        .proof-image-container {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #f3f4f6;
        }
        .proof-image {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .proof-image:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .reason-box {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 1rem;
            border-radius: 6px;
            margin-top: 1rem;
        }
        .reason-box-title {
            font-weight: 600;
            color: #dc2626;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }
        .reason-box-content {
            color: #7f1d1d;
            font-size: 0.875rem;
            margin: 0;
        }
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .empty-state-icon {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }
        .empty-state-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }
        .empty-state-text {
            color: #9ca3af;
            margin-bottom: 1.5rem;
        }
    </style>

    <!-- Balance Header -->
    <div class="topup-header-card">
        <div class="topup-header-content">
            <div class="balance-section">
                <div class="balance-label">
                    <i class="bi bi-wallet2"></i> Saldo Saat Ini
                </div>
                <h1 class="balance-amount">Rp{{ number_format(auth()->user()->balance, 0, ',', '.') }}</h1>
            </div>
            <div>
                <a href="{{ route('topups.create') }}" class="btn btn-light btn-lg">
                    <i class="bi bi-plus-circle"></i> Top-Up Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- Page Title -->
    <div class="mb-4">
        <h2 class="h4 mb-1">Riwayat Top-Up</h2>
        <p class="text-muted">Daftar permintaan dan status top-up saldo Anda</p>
    </div>

    <!-- Top-Up History -->
    @if($topups->isEmpty())
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <div class="empty-state-title">Belum Ada Riwayat Top-Up</div>
            <div class="empty-state-text">Anda belum pernah melakukan request top-up saldo</div>
            <a href="{{ route('topups.create') }}" class="btn btn-primary">
                <i class="bi bi-wallet2"></i> Request Top-Up Sekarang
            </a>
        </div>
    @else
        @foreach($topups as $topup)
            <div class="topup-card">
                <div class="topup-card-header">
                    <div class="topup-amount">
                        Rp{{ number_format($topup->amount, 0, ',', '.') }}
                    </div>
                    <span class="badge badge-{{ $topup->status == 'pending' ? 'warning' : ($topup->status == 'approved' ? 'success' : 'danger') }} badge-pill">
                        @if($topup->status == 'pending')
                            Menunggu Verifikasi
                        @elseif($topup->status == 'approved')
                            Disetujui
                        @else
                            Ditolak
                        @endif
                    </span>
                </div>
                <div class="topup-card-body">
                    <!-- Date -->
                    <div class="topup-info-row">
                        <div class="topup-info-icon" style="background: #dbeafe; color: #3b82f6;">
                            <i class="bi bi-calendar3"></i>
                        </div>
                        <div class="topup-info-content">
                            <div class="topup-info-label">Tanggal Request</div>
                            <div class="topup-info-value">{{ $topup->created_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="topup-info-row">
                        <div class="topup-info-icon" style="background: {{ $topup->status == 'pending' ? '#fef3c7' : ($topup->status == 'approved' ? '#d1fae5' : '#fee2e2') }}; color: {{ $topup->status == 'pending' ? '#f59e0b' : ($topup->status == 'approved' ? '#10b981' : '#ef4444') }};">
                            <i class="bi bi-{{ $topup->status == 'pending' ? 'clock' : ($topup->status == 'approved' ? 'check-circle' : 'x-circle') }}"></i>
                        </div>
                        <div class="topup-info-content">
                            <div class="topup-info-label">Status</div>
                            <div class="topup-info-value">
                                @if($topup->status == 'pending')
                                    Sedang diproses oleh admin
                                @elseif($topup->status == 'approved')
                                    Disetujui pada {{ $topup->updated_at->format('d M Y, H:i') }}
                                @else
                                    Ditolak pada {{ $topup->updated_at->format('d M Y, H:i') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Processed By (if approved/rejected) -->
                    @if($topup->processedBy)
                        <div class="topup-info-row">
                            <div class="topup-info-icon" style="background: #f3e8ff; color: #9333ea;">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <div class="topup-info-content">
                                <div class="topup-info-label">Diproses Oleh</div>
                                <div class="topup-info-value">{{ $topup->processedBy->name }}</div>
                            </div>
                        </div>
                    @endif

                    <!-- Rejection Reason -->
                    @if($topup->status == 'rejected' && $topup->reason)
                        <div class="reason-box">
                            <div class="reason-box-title">
                                <i class="bi bi-exclamation-triangle"></i> Alasan Penolakan
                            </div>
                            <p class="reason-box-content">{{ $topup->reason }}</p>
                        </div>
                    @endif

                    <!-- Proof Image -->
                    @if($topup->proof_image)
                        <div class="proof-image-container">
                            <div class="topup-info-label mb-2">Bukti Transfer</div>
                            <a href="{{ asset('storage/' . $topup->proof_image) }}" target="_blank">
                                <img src="{{ asset('storage/' . $topup->proof_image) }}"
                                     alt="Bukti Transfer"
                                     class="proof-image">
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
@endsection
