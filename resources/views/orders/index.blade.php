@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
    <style>
        .order-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }
        .order-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }
        .order-header {
            background: #f8f9fa;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .order-number {
            font-weight: 700;
            font-size: 0.875rem;
            color: #1a1a2e;
        }
        .order-date {
            font-size: 0.75rem;
            color: #6b7280;
        }
        .order-body {
            padding: 1.5rem;
        }
        .order-product {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .order-product img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
        }
        .order-product-info {
            flex: 1;
        }
        .order-product-name {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.25rem;
            color: #1a1a2e;
        }
        .order-product-details {
            font-size: 0.875rem;
            color: #6b7280;
        }
        .order-footer {
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .order-total {
            font-size: 0.875rem;
            color: #6b7280;
        }
        .order-total-amount {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a1a2e;
        }
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
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

    <div class="mb-4">
        <h1 class="h3 mb-1">Pesanan Saya</h1>
        <p class="text-muted">Riwayat dan status pesanan keyboard Anda</p>
    </div>

    @if($orders->isEmpty())
        <div class="order-card">
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-bag-x"></i>
                </div>
                <div class="empty-state-title">Belum Ada Pesanan</div>
                <div class="empty-state-text">Anda belum memiliki riwayat pesanan. Yuk mulai belanja keyboard impianmu!</div>
                <a href="{{ route('keyboards.index') }}" class="btn btn-primary">
                    <i class="bi bi-keyboard"></i> Lihat Katalog Keyboard
                </a>
            </div>
        </div>
    @else
        @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-number">{{ $order->order_number }}</div>
                        <div class="order-date">
                            <i class="bi bi-calendar3"></i> {{ $order->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                    <span class="badge badge-{{ $order->getStatusBadgeClass() }} badge-pill">
                        {{ $order->getStatusLabel() }}
                    </span>
                </div>
                <div class="order-body">
                    <div class="order-product">
                        @php
                            $fallbackImage = asset('images/No_Image_available.svg');
                            $imageSource = $order->keyboard->image_path ?? $fallbackImage;
                        @endphp
                        <img src="{{ $imageSource }}" alt="{{ $order->keyboard->name }}"
                             onerror="this.onerror=null;this.src='{{ $fallbackImage }}';">
                        <div class="order-product-info">
                            <div class="order-product-name">{{ $order->keyboard->name }}</div>
                            <div class="order-product-details">
                                <i class="bi bi-hash"></i> Jumlah: {{ $order->quantity }} unit
                            </div>
                            <div class="order-product-details">
                                <i class="bi bi-tag"></i> Harga: Rp{{ number_format($order->price_per_item, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                    <div class="order-footer">
                        <div>
                            <div class="order-total">Total Pembayaran</div>
                            <div class="order-total-amount">Rp{{ number_format($order->total_price, 0, ',', '.') }}</div>
                        </div>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
