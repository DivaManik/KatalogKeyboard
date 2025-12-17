@extends('layouts.app')

@section('title', 'Daftar Keyboard')

@section('content')
    <style>
        .filter-sidebar {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 1.5rem;
            position: sticky;
            top: 20px;
        }
        .filter-title {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .filter-reset {
            color: #0066FF;
            font-size: 0.875rem;
            cursor: pointer;
            text-decoration: none;
        }
        .filter-reset:hover {
            text-decoration: underline;
        }
        .filter-section {
            margin-bottom: 1.5rem;
        }
        .filter-section-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #6b7280;
            margin-bottom: 0.75rem;
            letter-spacing: 0.5px;
        }
        .filter-search {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .filter-search input {
            width: 100%;
            padding: 0.5rem 0.75rem 0.5rem 2rem;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 0.875rem;
        }
        .filter-search i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        .filter-checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        .filter-checkbox input[type="checkbox"] {
            margin-right: 0.5rem;
            cursor: pointer;
        }
        .filter-checkbox label {
            font-size: 0.875rem;
            cursor: pointer;
            margin: 0;
        }
        .size-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .size-pill {
            padding: 0.4rem 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
            background: white;
        }
        .size-pill:hover {
            border-color: #0066FF;
            color: #0066FF;
        }
        .size-pill.active {
            background: #0066FF;
            color: white;
            border-color: #0066FF;
        }
        .keyboard-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: all 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .keyboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }
        .keyboard-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .keyboard-card-body {
            padding: 1rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .keyboard-price-tag {
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            padding: 0.4rem 0.75rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.875rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .keyboard-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .sort-select {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
    </style>

    <div class="mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
            <div>
                <h1 class="h3 mb-1">KKB | Katalog Keyboard Bagus</h1>
                <p class="text-muted mb-2 mb-md-0">
                    Menampilkan {{ $keyboards->count() }} keyboard dalam katalog.
                </p>
            </div>
            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('keyboards.create') }}" class="btn btn-primary mt-3 mt-md-0">
                    + Tambah Keyboard
                </a>
            @endif
        </div>
    </div>

    <div class="row">
        <!-- Filter Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="filter-sidebar">
                <div class="filter-title">
                    <span>Filter</span>
                    <a href="{{ route('keyboards.index') }}" class="filter-reset">Reset</a>
                </div>

                <form method="GET" action="{{ route('keyboards.index') }}" id="filter-form">
                    <!-- Search -->
                    <div class="filter-search">
                        <i class="bi bi-search"></i>
                        <input type="text" name="search" placeholder="Cari keyboard..."
                               value="{{ request('search') }}" id="search-input">
                    </div>

                    <!-- Brand Filter -->
                    <div class="filter-section">
                        <div class="filter-section-title">BRAND</div>
                        @foreach($brands as $brand)
                            <div class="filter-checkbox">
                                <input type="checkbox" name="brand[]" value="{{ $brand }}"
                                       id="brand-{{ Str::slug($brand) }}"
                                       {{ in_array($brand, (array)request('brand', [])) ? 'checked' : '' }}>
                                <label for="brand-{{ Str::slug($brand) }}">{{ $brand }}</label>
                            </div>
                        @endforeach
                    </div>

                    <!-- Connection Filter -->
                    <div class="filter-section">
                        <div class="filter-section-title">KONEKTIVITAS</div>
                        <div class="filter-checkbox">
                            <input type="checkbox" name="connection[]" value="wired" id="conn-wired"
                                   {{ in_array('wired', (array)request('connection', [])) ? 'checked' : '' }}>
                            <label for="conn-wired">Wired</label>
                        </div>
                        <div class="filter-checkbox">
                            <input type="checkbox" name="connection[]" value="wireless" id="conn-wireless"
                                   {{ in_array('wireless', (array)request('connection', [])) ? 'checked' : '' }}>
                            <label for="conn-wireless">Wireless 2.4Ghz</label>
                        </div>
                        <div class="filter-checkbox">
                            <input type="checkbox" name="connection[]" value="hybrid" id="conn-hybrid"
                                   {{ in_array('hybrid', (array)request('connection', [])) ? 'checked' : '' }}>
                            <label for="conn-hybrid">Bluetooth</label>
                        </div>
                    </div>

                    <!-- Size Filter -->
                    <div class="filter-section">
                        <div class="filter-section-title">SIZE</div>
                        <div class="size-pills">
                            @foreach(['60%', '65%', '75%', 'TKL', 'Fullsize'] as $size)
                                <label class="size-pill {{ in_array($size, (array)request('layout', [])) ? 'active' : '' }}">
                                    <input type="checkbox" name="layout[]" value="{{ $size }}" style="display: none;">
                                    {{ $size }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="filter-section">
                        <div class="filter-section-title">HARGA</div>
                        <div class="mb-2">
                            <label class="small">Min</label>
                            <input type="number" name="min_price" class="form-control form-control-sm"
                                   placeholder="0" value="{{ request('min_price') }}">
                        </div>
                        <div class="mb-2">
                            <label class="small">Max</label>
                            <input type="number" name="max_price" class="form-control form-control-sm"
                                   placeholder="10000000" value="{{ request('max_price') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Keyboards Grid -->
        <div class="col-lg-9">
            <!-- Sort & View Options -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="text-muted small">
                    {{ $keyboards->count() }} hasil ditemukan
                </div>
                <div>
                    <select class="sort-select" id="sort-select" name="sort">
                        <option value="">Urutkan</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                            Harga: Termurah
                        </option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                            Harga: Termahal
                        </option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                            Terbaru
                        </option>
                    </select>
                </div>
            </div>

            <!-- Keyboards Grid -->
            @if($keyboards->isEmpty())
                <div class="alert alert-info">
                    Tidak ada keyboard yang ditemukan dengan filter yang dipilih.
                </div>
            @else
                <div class="row">
                    @foreach($keyboards as $keyboard)
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="keyboard-card">
                                <div style="position: relative;">
                                    @php
                                        $fallbackImage = asset('images/No_Image_available.svg');
                                        $imageSource = $keyboard->image_path ?? $fallbackImage;
                                    @endphp
                                    <img src="{{ $imageSource }}" alt="{{ $keyboard->name }}"
                                         onerror="this.onerror=null;this.src='{{ $fallbackImage }}';">

                                    @if($keyboard->stock <= 0)
                                        <div style="position: absolute; top: 10px; left: 10px; background: #dc3545; color: white; padding: 0.4rem 0.75rem; border-radius: 20px; font-weight: 700; font-size: 0.875rem; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                                            HABIS
                                        </div>
                                    @endif

                                    @if($keyboard->price)
                                        <div class="keyboard-price-tag">
                                            Rp {{ number_format($keyboard->price/1000, 0) }}k
                                        </div>
                                    @endif
                                </div>
                                <div class="keyboard-card-body">
                                    <div class="mb-2">
                                        <span class="keyboard-badge bg-primary text-white">
                                            {{ $keyboard->layout ?? 'N/A' }}
                                        </span>
                                        <span class="keyboard-badge bg-secondary text-white">
                                            {{ ucfirst($keyboard->brand) }}
                                        </span>
                                    </div>
                                    <h5 class="h6 font-weight-bold mb-1">{{ $keyboard->name }}</h5>
                                    <p class="text-muted small mb-2">
                                        {{ Str::limit($keyboard->description, 80) }}
                                    </p>
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge badge-{{ $keyboard->connection == 'wired' ? 'success' : ($keyboard->connection == 'wireless' ? 'info' : 'warning') }}">
                                                {{ ucfirst($keyboard->connection) }}
                                            </span>
                                            <div>
                                                @if (auth()->check() && auth()->user()->isGuest())
                                                    <a href="{{ route('keyboards.show', $keyboard) }}"
                                                    class="btn btn-success btn-sm" title="Beli">
                                                    <i class="bi bi-cart-plus"></i> Beli
                                                    </a>
                                                @endif

                                                @if(auth()->check() && auth()->user()->isAdmin())
                                                    <a href="{{ route('keyboards.edit', $keyboard) }}"
                                                       class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('filter-form');
            const searchInput = document.getElementById('search-input');
            const sortSelect = document.getElementById('sort-select');

            // Auto-submit on checkbox change
            const checkboxes = form.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    form.submit();
                });
            });

            // Auto-submit on sort change
            sortSelect.addEventListener('change', function() {
                const url = new URL(window.location);
                url.searchParams.set('sort', this.value);
                window.location = url.toString();
            });

            // Debounce search input
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    form.submit();
                }, 500);
            });

            // Price range inputs
            const priceInputs = form.querySelectorAll('input[type="number"]');
            priceInputs.forEach(input => {
                input.addEventListener('change', () => {
                    form.submit();
                });
            });

            // Size pills toggle
            const sizePills = document.querySelectorAll('.size-pill');
            sizePills.forEach(pill => {
                pill.addEventListener('click', function() {
                    const checkbox = this.querySelector('input[type="checkbox"]');
                    checkbox.checked = !checkbox.checked;
                    this.classList.toggle('active');
                    form.submit();
                });
            });
        });
    </script>
@endpush
