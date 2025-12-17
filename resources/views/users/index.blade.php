@extends('layouts.app')

@section('title', 'Daftar User')

@section('content')
    <div class="mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
            <div>
                <h1 class="h3 mb-1">Manajemen User</h1>
                <p class="text-muted mb-2 mb-md-0">
                    Menampilkan {{ $users->count() }} pengguna terdaftar.
                </p>
            </div>
            <a href="{{ route('users.create') }}" class="btn btn-primary mt-3 mt-md-0">
                + Tambah User
            </a>
        </div>
    </div>

    <div class="table-responsive shadow-sm rounded bg-white p-3">
        <table class="table table-striped table-bordered" id="users-table">
            <thead class="thead-light">
                <tr>
                    <th style="width: 60px;">No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Foto</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="align-middle"></td>
                        <td>
                            <div class="font-weight-bold">{{ $user->name }}</div>
                            <small class="text-muted">Dibuat {{ optional($user->created_at)->format('d M Y') ?? '-' }}</small>
                        </td>
                        <td class="align-middle">
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->role }}
                        </td>
                        <td>
                            @php
                                $fallbackPhoto = asset('images/No_Image_available.svg');
                                $photoUrl = $fallbackPhoto;

                                if (!empty($user->foto)) {
                                    $storage = \Illuminate\Support\Facades\Storage::disk('public');
                                    if ($storage->exists($user->foto)) {
                                        $photoUrl = asset('storage/' . $user->foto);
                                    }
                                }
                            @endphp
                            <img src="{{ $photoUrl }}"
                                 alt="Foto {{ $user->name }}"
                                 class="rounded"
                                 width="64"
                                 height="64"
                                 onerror="this.onerror=null;this.src='{{ $fallbackPhoto }}';">
                        </td>
                        <td class="text-center align-middle">
                            <form action="{{ route('users.destroy', $user) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="align-middle text-center text-muted">-</td>
                        <td class="text-center text-muted" data-empty-message>Belum ada data user.</td>
                        <td class="text-center text-muted">-</td>
                        <td class="text-center text-muted">-</td>
                        <td class="align-middle text-center text-muted">-</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initDataTable('#users-table', {
                columnDefs: [
                    { orderable: false, targets: [0, 3, 4] },
                ],
                order: [[1, 'asc']],
            });
        });
    </script>
@endpush
