@extends('layouts.app')

@section('title', 'Edit Keyboard: ' . $keyboard->name)

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h2 class="h4 mb-0">Perbarui Data Keyboard</h2>
                    <small class="text-muted">Ubah informasi keyboard sesuai kebutuhan.</small>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <p class="mb-2 font-weight-bold">Terjadi kesalahan:</p>
                            <ul class="mb-0 pl-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group text-center">
                        <label class="font-weight-bold d-block">Gambar Sebelumnya</label>
                        @php
                            $fallbackImage = asset('images/No_Image_available.svg');
                            $publicPath = public_path('storage/' . $keyboard->image_url);
                            $resourcePath = storage_path('app/public/' . $keyboard->image_url);
                        @endphp
                        @if ($keyboard->image_url && (file_exists($publicPath) || file_exists($resourcePath)))
                            <img src="{{ asset('storage/' . $keyboard->image_url) }}"
                                 alt="{{ $keyboard->name }}"
                                 class="img-fluid rounded shadow-sm mb-2"
                                 style="max-height: 200px;">
                        @else
                            <img src="{{ $fallbackImage }}"
                                 alt="No image"
                                 class="img-fluid rounded shadow-sm mb-2"
                                 style="max-height: 200px;">
                        @endif
                        <p class="text-muted small mb-0">Pratinjau gambar saat ini</p>
                    </div>

                    <form action="{{ route('keyboards.update', $keyboard) }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nama Keyboard</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $keyboard->name }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="brand">Brand*</label>
                                <input type="text" name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ $keyboard->brand }}" required>
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="switch_type">Jenis Switch</label>
                                <input type="text" name="switch_type" id="switch_type" class="form-control @error('switch_type') is-invalid @enderror" value="{{ $keyboard->switch_type }}">
                                @error('switch_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="layout">Layout</label>
                                <select name="layout" id="layout" class="form-control @error('layout') is-invalid @enderror">
                                    <option value="" {{ $keyboard->layout ? '' : 'selected' }}>Pilih layout</option>
                                    @foreach ($options['layout'] as $layout)
                                        <option value="{{ $layout }}" {{ $keyboard->layout === $layout ? 'selected' : '' }}>
                                            {{ $layout }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('layout')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="connection">Koneksi*</label>
                                <select name="connection" id="connection" class="form-control @error('connection') is-invalid @enderror" required>
                                    <option value="" disabled {{ $keyboard->connection ? '' : 'selected' }}>Pilih koneksi</option>
                                    @foreach ($options['connection'] as $connection)
                                        <option value="{{ $connection }}" {{ $keyboard->connection === $connection ? 'selected' : '' }}>
                                            {{ ucfirst($connection) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('connection')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Harga (Rp)</label>
                                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ $keyboard->price }}" min="0" step="50000">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="stock">Stok*</label>
                                <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ $keyboard->stock ?? 0 }}" min="0" required>
                                <small class="form-text text-muted">Jumlah unit yang tersedia</small>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="release_date">Tanggal Rilis</label>
                                <input type="date" name="release_date" id="release_date" class="form-control @error('release_date') is-invalid @enderror" value="{{ optional($keyboard->release_date)->format('Y-m-d') }}">
                                @error('release_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="image">Ganti Gambar</label>
                                <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*">
                                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti gambar. Maksimal 2MB.</small>
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" name="hot_swappable" id="hot_swappable" class="form-check-input" value="1" {{ $keyboard->hot_swappable ? 'checked' : '' }}>
                            <label class="form-check-label" for="hot_swappable">Hot-swappable</label>
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi*</label>
                            <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{ $keyboard->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('keyboards.show', $keyboard) }}" class="btn btn-link">Batal</a>
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
