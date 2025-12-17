@extends('layouts.app')

@section('title', 'KKB | Katalog Keyboard Bagus')

@section('content')
    <div class="jumbotron bg-white shadow-sm rounded py-5 px-4 px-md-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="display-4 font-weight-bold mb-3">Pusat katalog keyboard mekanik lokal</h1>
                <p class="lead text-muted mb-4">
                    Temukan inspirasi build, bandingkan spesifikasi, dan pantau rilisan terbaru dari berbagai brand favorit Anda.
                </p>
                <div class="d-flex flex-column flex-sm-row">
                    <a href="{{ route('keyboards.index') }}" class="btn btn-primary btn-lg mr-sm-3 mb-3 mb-sm-0">
                        Jelajahi Katalog
                    </a>
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('keyboards.create') }}" class="btn btn-outline-primary btn-lg">
                            Tambahkan Keyboard
                        </a>
                    @endif
                </div>
                <small class="text-muted d-block mt-3">
                    Data diperbarui otomatis dari hasil input peserta studi kasus.
                </small>
            </div>
            <div class="col-lg-5 mt-4 mt-lg-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <p class="text-uppercase text-muted mb-2 small font-weight-bold">Snapshot katalog</p>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span>Total keyboard</span>
                                <span class="font-weight-bold">{{ number_format($totalKeyboards) }}</span>
                            </li>
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span>Brand unik</span>
                                <span class="font-weight-bold">{{ number_format($brandCount) }}</span>
                            </li>
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span>Hot-swappable</span>
                                <span class="font-weight-bold">{{ number_format($hotSwapCount) }} ({{ $hotSwapPercentage }}%)</span>
                            </li>
                            <li class="d-flex justify-content-between py-2">
                                <span>Rilis terbaru</span>
                                <span class="font-weight-bold">
                                    {{ optional(optional($latestKeyboards->first())->release_date)->format('d M Y') ?? 'n/a' }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $connectionLabels = [
            'wired' => 'Wired',
            'wireless' => 'Wireless',
            'hybrid' => 'Hybrid',
        ];
    @endphp

    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h5 mb-0">Komposisi koneksi</h2>
            </div>
            <a href="{{ route('keyboards.index') }}" class="btn btn-sm btn-outline-primary">Lihat tabel lengkap</a>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($connectionLabels as $connection => $label)
                    @php
                        $count = $connectionBreakdown[$connection] ?? 0;
                        $percentage = $totalKeyboards > 0 ? round(($count / $totalKeyboards) * 100) : 0;
                    @endphp
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="border rounded p-3 h-100 d-flex flex-column justify-content-center text-center">
                            <span class="text-uppercase text-muted small">{{ $label }}</span>
                            <strong class="display-4">{{ $count }}</strong>
                            <span class="text-muted">({{ $percentage }}%)</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="h4 mb-1">Keyboard terbaru</h2>
        </div>
        @if(auth()->check() && auth()->user()->isAdmin())
            <a href="{{ route('keyboards.create') }}" class="btn btn-outline-secondary btn-sm">Kirim entri Anda</a>
        @endif
    </div>

    @if ($latestKeyboards->isEmpty())
        <div class="alert alert-info">
            Belum ada data keyboard untuk ditampilkan. Mulai dengan menambahkan produk pertama Anda.
        </div>
    @else
        <div class="row">
            @foreach ($latestKeyboards as $keyboard)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        @php
                            $fallbackImage = asset('images/No_Image_available.svg');
                            $cardImage = $keyboard->image_path ?? $fallbackImage;
                        @endphp
                        <img src="{{ $cardImage }}" class="card-img-top" alt="{{ $keyboard->name }}">
                        <div class="card-body d-flex flex-column">
                            <h3 class="h5 mb-1">{{ $keyboard->name }}</h3>
                            <small class="text-muted d-block mb-2">{{ $keyboard->brand }} &middot; {{ $keyboard->layout ?? 'Layout n/a' }}</small>
                            <p class="text-muted product-description mb-4">
                                {{ Str::limit($keyboard->description, 120) }}
                            </p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="badge badge-pill badge-info text-uppercase">{{ $keyboard->connection }}</span>
                                <a href="{{ route('keyboards.show', $keyboard) }}" class="btn btn-success btn-sm">
                                    <i class="bi bi-cart-plus"></i> Beli
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
