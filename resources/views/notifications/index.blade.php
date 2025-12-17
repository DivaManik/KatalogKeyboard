@extends('layouts.app')

@section('title', 'Semua Notifikasi')

@section('content')
    <style>
        .notification-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 1rem;
            transition: all 0.2s;
        }
        .notification-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }
        .notification-card.unread {
            border-left: 4px solid #0066FF;
            background: #f8f9ff;
        }
        .notification-icon-large {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        .notification-icon-large.order {
            background: #e3f2fd;
            color: #1976d2;
        }
        .notification-icon-large.topup {
            background: #e8f5e9;
            color: #388e3c;
        }
        .page-header {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
    </style>

    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1">Semua Notifikasi</h1>
                <p class="text-muted mb-0">Riwayat notifikasi Anda</p>
            </div>
            @if($notifications->where('is_read', false)->count() > 0)
                <button class="btn btn-primary" onclick="markAllAsRead()">
                    <i class="bi bi-check-all"></i> Tandai Semua Dibaca
                </button>
            @endif
        </div>
    </div>

    @if($notifications->count() > 0)
        @foreach($notifications as $notification)
            <div class="notification-card {{ !$notification->is_read ? 'unread' : '' }}" id="notification-{{ $notification->id }}">
                <div class="p-3">
                    <div class="d-flex align-items-start">
                        <div class="notification-icon-large {{ str_contains($notification->type, 'order') ? 'order' : 'topup' }}">
                            <i class="bi {{ str_contains($notification->type, 'order') ? 'bi-box-seam' : 'bi-cash-stack' }}"></i>
                        </div>
                        <div class="flex-grow-1 ml-3">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h6 class="mb-0 font-weight-bold">{{ $notification->title }}</h6>
                                @if(!$notification->is_read)
                                    <span class="badge badge-primary ml-2">Baru</span>
                                @endif
                            </div>
                            <p class="text-muted mb-2" style="font-size: 0.9rem;">{{ $notification->message }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i> {{ $notification->created_at->diffForHumans() }}
                                </small>
                                @if(!$notification->is_read)
                                    <button class="btn btn-sm btn-outline-primary" onclick="markAsRead({{ $notification->id }})">
                                        <i class="bi bi-check"></i> Tandai Dibaca
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-4">
            {{ $notifications->links() }}
        </div>
    @else
        <div class="notification-card text-center py-5">
            <i class="bi bi-inbox" style="font-size: 3rem; color: #9ca3af;"></i>
            <h5 class="mt-3 text-muted">Belum Ada Notifikasi</h5>
            <p class="text-muted">Notifikasi akan muncul di sini ketika ada aktivitas baru</p>
        </div>
    @endif
@endsection

@push('scripts')
<script>
    function markAsRead(notificationId) {
        fetch(`/notifications/${notificationId}/read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const card = document.getElementById(`notification-${notificationId}`);
                card.classList.remove('unread');
                const badge = card.querySelector('.badge-primary');
                if (badge) badge.remove();
                const button = card.querySelector('.btn-outline-primary');
                if (button) button.remove();

                // Reload page if no more unread notifications
                setTimeout(() => location.reload(), 500);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function markAllAsRead() {
        fetch('{{ route("notifications.readAll") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>
@endpush
