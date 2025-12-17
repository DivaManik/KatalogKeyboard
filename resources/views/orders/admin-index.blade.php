@extends('layouts.app')

@section('title', 'Kelola Pesanan')

@section('content')
    <style>
        .admin-header {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .stat-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .stat-info {
            flex: 1;
        }
        .stat-label {
            font-size: 0.75rem;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a2e;
        }
        .orders-table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 1.5rem;
        }
        .table th {
            font-weight: 600;
            font-size: 0.875rem;
            color: #6b7280;
            border-top: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table td {
            vertical-align: middle;
        }
        .order-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .order-user img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
        }
        .order-user-info {
            flex: 1;
        }
        .order-user-name {
            font-weight: 600;
            color: #1a1a2e;
            font-size: 0.875rem;
        }
        .order-user-email {
            font-size: 0.75rem;
            color: #6b7280;
        }
        .product-info {
            font-weight: 600;
            color: #1a1a2e;
        }
        .product-meta {
            font-size: 0.75rem;
            color: #6b7280;
        }
        .status-select {
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            cursor: pointer;
        }
        .action-btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
    </style>

    <div class="admin-header">
        <h1 class="h3 mb-1">Kelola Pesanan</h1>
        <p class="text-muted mb-0">Pantau dan kelola semua pesanan dari pelanggan</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-icon" style="background: #fef3c7; color: #f59e0b;">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Menunggu</div>
                <div class="stat-value">{{ $orders->where('status', 'pending')->count() }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #dbeafe; color: #3b82f6;">
                <i class="bi bi-gear-fill"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Diproses</div>
                <div class="stat-value">{{ $orders->where('status', 'processing')->count() }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #e0e7ff; color: #6366f1;">
                <i class="bi bi-truck"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Dikirim</div>
                <div class="stat-value">{{ $orders->where('status', 'shipped')->count() }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #d1fae5; color: #10b981;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Selesai</div>
                <div class="stat-value">{{ $orders->where('status', 'delivered')->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="orders-table-container">
        <table class="table table-hover" id="ordersTable">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Nomor Order</th>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $order->order_number }}</strong>
                        </td>
                        <td>
                            <div class="order-user">
                                <img src="{{ $order->user->foto ? asset('storage/' . $order->user->foto) : 'https://via.placeholder.com/40' }}"
                                     alt="{{ $order->user->name }}">
                                <div class="order-user-info">
                                    <div class="order-user-name">{{ $order->user->name }}</div>
                                    <div class="order-user-email">{{ $order->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="product-info">{{ $order->keyboard->name }}</div>
                            <div class="product-meta">{{ $order->keyboard->brand }}</div>
                        </td>
                        <td>{{ $order->quantity }}x</td>
                        <td>
                            <strong>Rp{{ number_format($order->total_price, 0, ',', '.') }}</strong>
                        </td>
                        <td>
                            <span class="badge badge-{{ $order->getStatusBadgeClass() }}">
                                {{ $order->getStatusLabel() }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary action-btn"
                                    data-toggle="modal"
                                    data-target="#updateStatusModal{{ $order->id }}"
                                    {{ in_array($order->status, ['delivered', 'cancelled']) ? 'disabled' : '' }}>
                                <i class="bi bi-pencil-square"></i> Update
                            </button>
                            
                        </td>
                    </tr>

                    <!-- Update Status Modal -->
                    <div class="modal fade" id="updateStatusModal{{ $order->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Status Pesanan</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <p><strong>Order:</strong> {{ $order->order_number }}</p>
                                            <p><strong>Pelanggan:</strong> {{ $order->user->name }}</p>
                                            <p><strong>Produk:</strong> {{ $order->keyboard->name }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="status{{ $order->id }}">Status Baru</label>
                                            <select name="status" id="status{{ $order->id }}" class="form-control" required>
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                    Menunggu Konfirmasi
                                                </option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                                    Diproses
                                                </option>
                                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                                    Dikirim
                                                </option>
                                                <option value="in_distribution" {{ $order->status == 'in_distribution' ? 'selected' : '' }}>
                                                    Di Distribution Center
                                                </option>
                                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                                    Terkirim
                                                </option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                                    Dibatalkan
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="notes{{ $order->id }}">Catatan (Opsional)</label>
                                            <textarea name="notes" id="notes{{ $order->id }}" class="form-control" rows="3"
                                                      placeholder="Tambahkan catatan jika diperlukan...">{{ $order->notes }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Update Status
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.initDataTable('#ordersTable', {
                order: [[7, 'desc']], // Sort by date column (descending)
                columnDefs: [
                    { orderable: false, targets: [8] } // Disable sorting on action column
                ]
            }, 0);
        });
    </script>
@endpush
