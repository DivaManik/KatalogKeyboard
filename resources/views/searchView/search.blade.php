@extends('layouts.guest')

@section('title', 'Cari Keyboard | KKB')

@section('navbar-class', 'navbar-transparent')

@push('styles')
<style>
    body {
        overflow-x: hidden;
    }
    .hero-section {
        min-height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ asset('images/keyboard.jpg') }}');
        background-size: cover;
        background-position: center right;
        z-index: 0;
    }
    .hero-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0.98) 0%, rgba(255,255,255,0.95) 50%, rgba(255,255,255,0.7) 100%);
        backdrop-filter: blur(2px);
    }
    .hero-bg::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 50%;
        height: 100%;
        background: rgba(0, 102, 255, 0.03);
    }
    .hero-content {
        position: relative;
        z-index: 1;
    }
    .hero-title {
        font-size: 3rem;
        font-weight: 800;
        line-height: 1.2;
        color: #1a1a2e;
        margin-bottom: 1.5rem;
    }
    .hero-title .highlight {
        color: #0066FF;
    }
    .hero-subtitle {
        font-size: 1.1rem;
        color: #6b7280;
        line-height: 1.7;
        margin-bottom: 2rem;
        max-width: 500px;
    }
    .search-box {
        display: flex;
        align-items: center;
        background: #ffffff;
        border-radius: 50px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 6px 6px 6px 20px;
        max-width: 500px;
        border: 1px solid #e5e7eb;
    }
    .search-box:focus-within {
        border-color: #0066FF;
        box-shadow: 0 4px 20px rgba(0, 102, 255, 0.15);
    }
    .search-icon {
        color: #9ca3af;
        font-size: 1.2rem;
        margin-right: 12px;
    }
    .search-input {
        flex: 1;
        border: none;
        outline: none;
        font-size: 1rem;
        color: #374151;
        background: transparent;
        padding: 12px 0;
    }
    .search-input::placeholder {
        color: #9ca3af;
    }
    .search-btn {
        background: #0066FF;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 28px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .search-btn:hover {
        background: #0052cc;
        transform: translateY(-1px);
    }
    .popular-tags {
        margin-top: 1.5rem;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }
    .popular-label {
        font-size: 0.9rem;
        color: #6b7280;
        margin-right: 4px;
    }
    .tag-link {
        color: #0066FF;
        font-size: 0.9rem;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }
    .tag-link:hover {
        color: #0052cc;
        text-decoration: underline;
    }
    .tag-separator {
        color: #d1d5db;
        margin: 0 4px;
    }
    .navbar-transparent {
        background: transparent !important;
        position: absolute;
        width: 100%;
        top: 0;
        z-index: 100;
        padding: 1.5rem 0;
        box-shadow: none;
    }

    @media (max-width: 991px) {
        .hero-title {
            font-size: 2.2rem;
        }
        .hero-bg::before {
            background: linear-gradient(to right, rgba(255,255,255,0.97) 0%, rgba(255,255,255,0.9) 100%);
        }
    }
    @media (max-width: 576px) {
        .hero-title {
            font-size: 1.8rem;
        }
        .hero-bg::before {
            background: rgba(255,255,255,0.96);
        }
        .search-box {
            flex-direction: column;
            border-radius: 16px;
            padding: 16px;
        }
        .search-input {
            width: 100%;
            text-align: center;
        }
        .search-btn {
            width: 100%;
            margin-top: 12px;
        }
        .search-icon {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 hero-content">
                <h1 class="hero-title">
                    Temukan Keyboard<br>
                    <span class="highlight">Impian Anda</span>
                </h1>
                <p class="hero-subtitle">
                    Jelajahi koleksi lengkap keyboard mekanik premium,
                    custom build, dan aksesoris terbaru. Tingkatkan
                    pengalaman mengetik Anda hari ini.
                </p>

                <!-- Search Form -->
                <form action="{{ route('search.results') }}" method="GET">
                    <div class="search-box">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" name="search" class="search-input"
                               placeholder="Cari keyboard, switch, atau brand...">
                        <button type="submit" class="search-btn">Cari</button>
                    </div>
                </form>

                <!-- Popular Tags -->
                <div class="popular-tags">
                    <span class="popular-label">Populer:</span>
                    <a href="{{ route('search.results', ['search' => 'Keychron Q1']) }}" class="tag-link">Keychron Q1</a>
                    <span class="tag-separator">·</span>
                    <a href="{{ route('search.results', ['search' => 'GMMK Pro']) }}" class="tag-link">GMMK Pro</a>
                    <span class="tag-separator">·</span>
                    <a href="{{ route('search.results', ['search' => 'Tofu65']) }}" class="tag-link">Tofu65</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
