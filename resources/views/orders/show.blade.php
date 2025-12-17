@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')
    <style>
        .order-header {
            background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
            color: white;
            padding: 2rem;
            border-radius: 8px 8px 0 0;
        }
        .status-timeline {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin: 2rem 0;
            padding: 0 2rem;
        }
        .status-timeline::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 2rem;
            right: 2rem;
            height: 3px;
            background: #e5e7eb;
            z-index: 0;
        }
        .status-step {
            position: relative;
            text-align: center;
            flex: 1;
            z-index: 1;
        }
        .status-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            position: relative;
            z-index: 2;
            border: 3px solid white;
        }
        .status-step.active .status-icon {
            background: #10b981;
            color: white;
        }
        .status-step.cancelled .status-icon {
            background: #dc3545;
            color: white;
        }
        .status-label {
            font-size: 0.75rem;
            color: #6b7280;
            font-weight: 500;
        }
        .status-step.active .status-label {
            color: #10b981;
            font-weight: 700;
        }
        .status-step.cancelled .status-label {
            color: #dc3545;
            font-weight: 700;
        }
        .order-summary-card {
            background: #f9fafb;
            border-radius: 8px;
            padding: 1.5rem;
        }
    </style>

    <div class="container">
        <a href="{{ route('orders.index') }}" class="btn btn-link p-0 mb-3">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesanan
        </a>

        <div class="card shadow-sm border-0 mb-4">
            <!-- Order Header -->
            <div class="order-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="h3 mb-1">Pesanan #{{ $order->order_number }}</h1>
                        <p class="mb-0 opacity-75">
                            <i class="bi bi-calendar"></i> {{ $order->created_at->format('d F Y, H:i') }}
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        @php
                            $statusBadges = [
                                'pending' => 'warning',
                                'processing' => 'info',
                                'shipped' => 'primary',
                                'in_distribution' => 'primary',
                                'delivered' => 'success',
                                'cancelled' => 'danger',
                            ];
                            $statusLabels = [
                                'pending' => 'Menunggu Konfirmasi',
                                'processing' => 'Sedang Diproses',
                                'shipped' => 'Sudah Dikirim',
                                'in_distribution' => 'Dalam Distribusi',
                                'delivered' => 'Sudah Sampai',
                                'cancelled' => 'Dibatalkan',
                            ];
                        @endphp
                        <span class="badge badge-{{ $statusBadges[$order->status] }} badge-lg px-3 py-2" style="font-size: 1rem;">
                            {{ $statusLabels[$order->status] }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <!-- Status Timeline -->
                @if($order->status !== 'cancelled')
                    <div class="status-timeline">
                        @php
                            $steps = ['pending', 'processing', 'shipped', 'in_distribution', 'delivered'];
                            $currentIndex = array_search($order->status, $steps);
                            $stepIcons = [
                                'pending' => 'bi-clock',
                                'processing' => 'bi-gear',
                                'shipped' => 'bi-truck',
                                'in_distribution' => 'bi-box-seam',
                                'delivered' => 'bi-check-circle',
                            ];
                            $stepNames = [
                                'pending' => 'Konfirmasi',
                                'processing' => 'Diproses',
                                'shipped' => 'Dikirim',
                                'in_distribution' => 'Distribusi',
                                'delivered' => 'Sampai',
                            ];
                        @endphp

                        @foreach($steps as $index => $step)
                            <div class="status-step {{ $index <= $currentIndex ? 'active' : '' }}">
                                <div class="status-icon">
                                    <i class="{{ $stepIcons[$step] }}"></i>
                                </div>
                                <div class="status-label">{{ $stepNames[$step] }}</div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="status-timeline">
                        <div class="status-step cancelled">
                            <div class="status-icon">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <div class="status-label">Pesanan Dibatalkan</div>
                        </div>
                    </div>
                @endif

                <!-- Order Items -->
                <h5 class="mb-3 mt-4">Detail Produk</h5>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center mb-3 mb-md-0">
                                @if($keyboard->image_path)
                                    <img src="{{ $keyboard->image_path }}" alt="{{ $keyboard->name }}" class="img-fluid rounded" style="max-height: 100px;">
                                @else
                                    <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center" style="height: 100px;">
                                        <span class="h3 mb-0">{{ strtoupper(substr($keyboard->brand, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-1">{{ $keyboard->name }}</h6>
                                <p class="text-muted small mb-2">{{ $keyboard->brand }} • {{ $keyboard->layout }}</p>
                                <div class="d-flex gap-2">
                                    <span class="badge badge-info">{{ ucfirst($keyboard->connection) }}</span>
                                    @if($keyboard->hot_swappable)
                                        <span class="badge badge-success">Hot-swappable</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                                <div class="text-muted small">Harga Satuan</div>
                                <div class="font-weight-bold">Rp{{ number_format($order->price_per_item, 0, ',', '.') }}</div>
                                <div class="text-muted small mt-2">Jumlah: <strong>{{ $order->quantity }} unit</strong></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Shipping Information -->
                    <div class="col-md-7 mb-4">
                        <h5 class="mb-3">Informasi Pengiriman</h5>
                        <div class="order-summary-card">
                            <div class="mb-3">
                                <div class="small text-muted mb-1">Nama Penerima</div>
                                <div class="font-weight-bold">{{ $order->user->name }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="small text-muted mb-1">No. Telepon</div>
                                <div class="font-weight-bold">{{ $order->phone }}</div>
                            </div>
                            <div>
                                <div class="small text-muted mb-1">Alamat Pengiriman</div>
                                <div class="font-weight-bold">{{ $order->shipping_address }}</div>
                            </div>
                            @if($order->notes)
                                <div class="mt-3">
                                    <div class="small text-muted mb-1">Catatan Admin</div>
                                    <div class="alert alert-info small mb-0">{{ $order->notes }}</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-md-5 mb-4">
                        <h5 class="mb-3">Ringkasan Pesanan</h5>
                        <div class="order-summary-card">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal ({{ $order->quantity }} item)</span>
                                <span class="font-weight-bold">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Ongkir</span>
                                <span class="font-weight-bold text-success">GRATIS</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span class="h6 mb-0">Total</span>
                                <span class="h5 mb-0 text-primary">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>

                            @if($order->status === 'cancelled')
                                <div class="alert alert-success mt-3 mb-0">
                                    <i class="bi bi-check-circle"></i> Saldo telah dikembalikan
                                </div>
                                <a href="{{ route('keyboards.show', $keyboard->id) }}" class="btn btn-success btn-block mt-3">
                                    <i class="bi bi-cart-plus"></i> Beli Lagi
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
