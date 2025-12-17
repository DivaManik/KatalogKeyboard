@extends('layouts.app')

@section('title', 'Detail Keyboard: ' . $keyboard->name)

@section('content')
<style>
    .image-zoom-container {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        cursor: zoom-in;
    }

    .image-zoom-container img {
        display: block;
        transition: transform 0.3s ease;
        transform-origin: center center;
    }

    .image-zoom-container:hover img {
        transform: scale(1.5);
        cursor: zoom-out;
    }

    .modal-body img {
        max-width: 100%;
        height: auto;
    }
</style>
<div class="container">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-transparent p-0">
            <li class="breadcrumb-item"><a href="{{ route('keyboards.index') }}">Katalog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $keyboard->name }}</li>
        </ol>
    </nav>
    <div class="row">
        <!-- Gambar Keyboard -->
        <div class="col-md-5 mb-4">
            <div class="position-relative">
                @if ($keyboard->connection)
                    <span class="badge badge-info position-absolute" style="top:10px;left:10px;z-index:2;">{{ ucfirst($keyboard->connection) }}</span>
                @endif
                <div class="bg-white rounded shadow-sm p-2">
                    @if ($keyboard->image_path)
                        <div class="image-zoom-container" style="max-height: 350px;">
                            <img src="{{ $keyboard->image_path }}" alt="{{ $keyboard->name }}" class="img-fluid rounded w-100" style="object-fit:cover;max-height:350px;">
                        </div>
                    @else
                        <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center" style="height: 220px;">
                            <span class="display-4 font-weight-bold">{{ strtoupper(substr($keyboard->brand, 0, 1)) }}</span>
                        </div>
                    @endif
                </div>
                <!-- Thumbnail preview (dummy, bisa diisi jika ada multi gambar) -->
                <!-- <div class="d-flex mt-3">
                    <div class="border rounded p-1 mr-2" style="width:70px;height:50px;overflow:hidden;">
                        @if ($keyboard->image_path)
                            <img src="{{ $keyboard->image_path }}" class="img-fluid" style="object-fit:cover;height:100%;">
                        @else
                            <span class="text-muted">No Img</span>
                        @endif
                    </div>
                    <div class="border rounded p-1 mr-2 d-flex align-items-center justify-content-center bg-light" style="width:70px;height:50px;">
                        <i class="bi bi-image text-muted"></i>
                    </div>
                    <div class="border rounded p-1 d-flex align-items-center justify-content-center bg-light" style="width:70px;height:50px;">
                        <i class="bi bi-image text-muted"></i>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- Info Keyboard -->
        <div class="col-md-4 mb-4">
            <div>
                <span class="text-uppercase text-primary font-weight-bold small">{{ $keyboard->brand }}</span>
                <h2 class="font-weight-bold mb-1">{{ $keyboard->name }}</h2>
                <div class="h4 font-weight-bold mb-3">Rp {{ number_format($keyboard->price, 0, ',', '.') }}</div>
                <div class="card mb-3">
                    <div class="card-body py-3">
                        <h6 class="mb-3 text-primary"><i class="bi bi-sliders mr-1"></i> Spesifikasi Teknis</h6>
                        <div class="row mb-2">
                            <div class="col-6 small text-muted">Brand</div>
                            <div class="col-6 font-weight-bold">{{ $keyboard->brand }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 small text-muted">Switch Type</div>
                            <div class="col-6 font-weight-bold">{{ $keyboard->switch_type ?? 'Tidak diketahui' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 small text-muted">Layout</div>
                            <div class="col-6 font-weight-bold">{{ $keyboard->layout ?? 'Tidak diketahui' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 small text-muted">Hot-swappable</div>
                            <div class="col-6 font-weight-bold">
                                {!! $keyboard->hot_swappable ? '<span class="text-success"><i class="bi bi-check-circle-fill"></i> Ya</span>' : '<span class="text-danger"><i class="bi bi-x-circle-fill"></i> Tidak</span>' !!}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 small text-muted">Tanggal Rilis</div>
                            <div class="col-6 font-weight-bold">{{ optional($keyboard->release_date)->format('d F Y') ?? 'n/a' }}</div>
                        </div>
                        <hr class="my-2">
                        <div class="row mb-0">
                            <div class="col-6 small text-muted">Stok Tersedia</div>
                            <div class="col-6">
                                @if($keyboard->stock <= 0)
                                    <span class="badge badge-danger">HABIS</span>
                                @elseif($keyboard->stock <= 5)
                                    <span class="badge badge-warning">{{ $keyboard->stock }} unit</span>
                                @else
                                    <span class="badge badge-success">{{ $keyboard->stock }} unit</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Box Beli -->
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h6 class="mb-3 font-weight-bold">Beli Keyboard Ini</h6>
                    @if(auth()->check() && auth()->user()->isGuest() && !is_null($keyboard->price))
                        @if($keyboard->stock <= 0)
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle-fill"></i> <strong>Stok Habis</strong>
                                <p class="mb-0 small">Maaf, keyboard ini saat ini tidak tersedia.</p>
                            </div>
                            <button type="button" class="btn btn-secondary btn-block" disabled>
                                <i class="bi bi-x-circle"></i> Stok Habis
                            </button>
                        @else
                            <form action="{{ route('orders.store') }}" method="POST" id="buyForm" class="mb-3">
                                @csrf
                                <input type="hidden" name="keyboard_id" value="{{ $keyboard->id }}">
                                <input type="hidden" name="price" value="{{ $keyboard->price }}" id="unitPrice">
                                <div class="form-group mb-2">
                                    <label for="quantity" class="small font-weight-bold mb-1">Jumlah</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('quantity').stepDown();document.getElementById('quantity').dispatchEvent(new Event('input'));">-</button>
                                        </div>
                                        <input type="number" class="form-control text-center" name="quantity" id="quantity" value="1" min="1" max="{{ $keyboard->stock }}" required style="max-width:60px;">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('quantity').stepUp();document.getElementById('quantity').dispatchEvent(new Event('input'));">+</button>
                                        </div>
                                    </div>
                                    <small class="text-muted">Maksimal {{ $keyboard->stock }} unit</small>
                                </div>
                                <div class="mb-2 d-flex justify-content-between small">
                                    <span class="text-muted">Harga Satuan</span>
                                    <span class="font-weight-bold">Rp{{ number_format($keyboard->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="mb-2 d-flex justify-content-between">
                                    <span class="font-weight-bold">Total Harga</span>
                                    <span class="font-weight-bold text-primary" id="totalPrice">Rp{{ number_format($keyboard->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="mb-2 d-flex justify-content-between small">
                                    <span class="text-muted">Saldo Anda</span>
                                    <span class="font-weight-bold text-success">Rp{{ number_format(auth()->user()->balance, 0, ',', '.') }}</span>
                                </div>
                                <button type="submit" class="btn btn-success btn-block mb-2">
                                    <i class="bi bi-cart-check-fill"></i> Beli Sekarang
                                </button>
                            </form>
                        @endif
                    @elseif(!is_null($keyboard->price) && auth()->guest())
                        <a href="{{ route('login') }}" class="btn btn-primary btn-block mb-2">
                            <i class="bi bi-lock-fill"></i> Login untuk Membeli
                        </a>
                    @endif
                    <!-- @if ($keyboard->buy_link)
                        <a href="{{ $keyboard->buy_link }}" target="_blank" rel="noopener" class="btn btn-outline-secondary btn-block mb-2">
                            <i class="bi bi-box-arrow-up-right"></i> Lihat di Toko Online
                        </a>
                    @endif -->
                    <!-- <div class="text-center mt-auto pt-2 small text-success">
                        <i class="bi bi-shield-check"></i> Garansi Resmi 1 Tahun
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Deskripsi Keyboard -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="mb-3">Deskripsi Keyboard</h4>
                    <p class="product-description pre-line mb-0">{!! nl2br(e($keyboard->description)) !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity');
        const totalPriceElement = document.getElementById('totalPrice');
        const unitPriceInput = document.getElementById('unitPrice');

        if (quantityInput && totalPriceElement && unitPriceInput) {
            const unitPrice = parseFloat(unitPriceInput.value);

            quantityInput.addEventListener('input', function() {
                const quantity = parseInt(this.value) || 1;
                const total = unitPrice * quantity;

                // Format number with thousand separator
                const formatted = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(total);

                totalPriceElement.textContent = formatted;
            });
        }
    });
</script>
@endpush
