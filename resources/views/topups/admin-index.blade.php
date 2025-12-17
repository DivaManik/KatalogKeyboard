@extends('layouts.app')

@section('title', 'Kelola Top-Up')

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
        .topups-table-container {
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
        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
        }
        .user-name {
            font-weight: 600;
            color: #1a1a2e;
            font-size: 0.875rem;
        }
        .user-email {
            font-size: 0.75rem;
            color: #6b7280;
        }
        .amount-display {
            font-weight: 700;
            font-size: 1rem;
            color: #1a1a2e;
        }
        .proof-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .proof-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .action-btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
        .modal-proof-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>

    <div class="admin-header">
        <h1 class="h3 mb-1">Kelola Permintaan Top-Up</h1>
        <p class="text-muted mb-0">Verifikasi dan proses permintaan top-up saldo dari pelanggan</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-icon" style="background: #fef3c7; color: #f59e0b;">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Pending</div>
                <div class="stat-value">{{ $topups->where('status', 'pending')->count() }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #d1fae5; color: #10b981;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Disetujui</div>
                <div class="stat-value">{{ $topups->where('status', 'approved')->count() }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #fee2e2; color: #ef4444;">
                <i class="bi bi-x-circle-fill"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Ditolak</div>
                <div class="stat-value">{{ $topups->where('status', 'rejected')->count() }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #dbeafe; color: #3b82f6;">
                <i class="bi bi-cash-stack"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Approved</div>
                <div class="stat-value">Rp{{ number_format($topups->where('status', 'approved')->sum('amount') / 1000, 0) }}k</div>
            </div>
        </div>
    </div>

    <!-- Top-Ups Table -->
    <div class="topups-table-container">
        <table class="table table-hover" id="topupsTable">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>User</th>
                    <th>Jumlah</th>
                    <th>Bukti Transfer</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topups as $topup)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="user-info">
                                <img src="{{ $topup->user->foto ? asset('storage/' . $topup->user->foto) : 'https://via.placeholder.com/40' }}"
                                     alt="{{ $topup->user->name }}">
                                <div>
                                    <div class="user-name">{{ $topup->user->name }}</div>
                                    <div class="user-email">{{ $topup->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="amount-display">Rp{{ number_format($topup->amount, 0, ',', '.') }}</div>
                        </td>
                        <td>
                            @if($topup->proof_image)
                                <img src="{{ asset('storage/' . $topup->proof_image) }}"
                                     alt="Bukti Transfer"
                                     class="proof-thumbnail"
                                     data-toggle="modal"
                                     data-target="#proofModal{{ $topup->id }}">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $topup->status == 'pending' ? 'warning' : ($topup->status == 'approved' ? 'success' : 'danger') }}">
                                @if($topup->status == 'pending')
                                    Pending
                                @elseif($topup->status == 'approved')
                                    Disetujui
                                @else
                                    Ditolak
                                @endif
                            </span>
                        </td>
                        <td>{{ $topup->created_at->format('d M Y') }}</td>
                        <td>
                            @if($topup->status == 'pending')
                                <button type="button" class="btn btn-sm btn-success action-btn"
                                        data-toggle="modal"
                                        data-target="#approveModal{{ $topup->id }}">
                                    <i class="bi bi-check-circle"></i> Setuju
                                </button>
                                <button type="button" class="btn btn-sm btn-danger action-btn"
                                        data-toggle="modal"
                                        data-target="#rejectModal{{ $topup->id }}">
                                    <i class="bi bi-x-circle"></i> Tolak
                                </button>
                            @else
                                <span class="text-muted small">
                                    Diproses oleh {{ $topup->processedBy->name ?? '-' }}
                                </span>
                            @endif
                        </td>
                    </tr>

                    <!-- Proof Image Modal -->
                    @if($topup->proof_image)
                        <div class="modal fade" id="proofModal{{ $topup->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Bukti Transfer - {{ $topup->user->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('storage/' . $topup->proof_image) }}"
                                             alt="Bukti Transfer"
                                             class="modal-proof-image">
                                        <div class="mt-3">
                                            <p><strong>Jumlah Top-Up:</strong> Rp{{ number_format($topup->amount, 0, ',', '.') }}</p>
                                            <p><strong>Tanggal Request:</strong> {{ $topup->created_at->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Approve Modal -->
                    <div class="modal fade" id="approveModal{{ $topup->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title">
                                        <i class="bi bi-check-circle"></i> Setujui Top-Up
                                    </h5>
                                    <button type="button" class="close text-white" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('topups.approve', $topup) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <p><strong>User:</strong> {{ $topup->user->name }}</p>
                                            <p><strong>Email:</strong> {{ $topup->user->email }}</p>
                                            <p><strong>Jumlah Top-Up:</strong> <span class="text-success font-weight-bold">Rp{{ number_format($topup->amount, 0, ',', '.') }}</span></p>
                                            <p><strong>Saldo Saat Ini:</strong> Rp{{ number_format($topup->user->balance, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="alert alert-success">
                                            <i class="bi bi-info-circle"></i> Saldo user akan ditambahkan otomatis setelah disetujui.
                                        </div>
                                        <div class="form-group">
                                            <label for="approve_reason{{ $topup->id }}">Catatan (Opsional)</label>
                                            <textarea name="reason" id="approve_reason{{ $topup->id }}" class="form-control" rows="2"
                                                      placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-check-circle"></i> Setujui Top-Up
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Reject Modal -->
                    <div class="modal fade" id="rejectModal{{ $topup->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">
                                        <i class="bi bi-x-circle"></i> Tolak Top-Up
                                    </h5>
                                    <button type="button" class="close text-white" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('topups.reject', $topup) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <p><strong>User:</strong> {{ $topup->user->name }}</p>
                                            <p><strong>Jumlah Top-Up:</strong> Rp{{ number_format($topup->amount, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="alert alert-danger">
                                            <i class="bi bi-exclamation-triangle"></i> Pastikan Anda memberikan alasan penolakan yang jelas kepada user.
                                        </div>
                                        <div class="form-group">
                                            <label for="reject_reason{{ $topup->id }}">Alasan Penolakan <span class="text-danger">*</span></label>
                                            <textarea name="reason" id="reject_reason{{ $topup->id }}" class="form-control" rows="3"
                                                      placeholder="Contoh: Bukti transfer tidak jelas, nominal tidak sesuai, dll..."
                                                      required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-x-circle"></i> Tolak Top-Up
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

    <!-- Sales Statistics Section -->
    <div class="mt-5">
        <div class="admin-header">
            <h2 class="h4 mb-1">Statistik Penjualan</h2>
            <p class="text-muted mb-0">Ringkasan penjualan keyboard dari pesanan yang berhasil</p>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="stat-icon mr-3" style="background: #e0e7ff; color: #6366f1;">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div>
                                <h3 class="h6 text-muted mb-0">Total Pendapatan</h3>
                                <small class="text-muted">Dari pesanan yang disetujui & terkirim</small>
                            </div>
                        </div>
                        <div class="text-center py-3">
                            <h2 class="display-4 font-weight-bold text-primary mb-0">
                                Rp{{ number_format($totalRevenue, 0, ',', '.') }}
                            </h2>
                        </div>
                        <hr>
                        <div class="text-center text-muted small">
                            <i class="bi bi-info-circle"></i> Termasuk pesanan dengan status: Diproses, Dikirim, Dalam Distribusi, dan Terkirim
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="stat-icon mr-3" style="background: #fce7f3; color: #ec4899;">
                                <i class="bi bi-bag-check-fill"></i>
                            </div>
                            <div>
                                <h3 class="h6 text-muted mb-0">Barang Terjual</h3>
                                <small class="text-muted">Total unit keyboard yang terjual</small>
                            </div>
                        </div>
                        <div class="text-center py-3">
                            <h2 class="display-4 font-weight-bold text-danger mb-0">
                                {{ number_format($totalItemsSold) }}
                            </h2>
                            <p class="text-muted mb-0">Unit</p>
                        </div>
                        <hr>
                        <div class="text-center text-muted small">
                            <i class="bi bi-info-circle"></i> Jumlah total unit dari semua pesanan yang berhasil
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Breakdown Table -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white">
                <h3 class="h5 mb-0">Detail Barang Terjual</h3>
                <small class="text-muted">Rincian penjualan per keyboard</small>
            </div>
            <div class="card-body">
                @if($salesBreakdown->isEmpty())
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle"></i> Belum ada keyboard yang terjual.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover" id="salesTable">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Nama Keyboard</th>
                                    <th>Brand</th>
                                    <th class="text-center">Jumlah Terjual</th>
                                    <th class="text-center">Jumlah Order</th>
                                    <th class="text-right">Total Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($salesBreakdown as $sale)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="font-weight-bold">{{ $sale->keyboard->name }}</div>
                                        </td>
                                        <td>{{ $sale->keyboard->brand }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-primary badge-pill">{{ number_format($sale->total_quantity) }} unit</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-secondary badge-pill">{{ number_format($sale->order_count) }} order</span>
                                        </td>
                                        <td class="text-right">
                                            <strong class="text-success">Rp{{ number_format($sale->total_revenue, 0, ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-light font-weight-bold">
                                    <td colspan="3" class="text-right">TOTAL</td>
                                    <td class="text-center">
                                        <span class="badge badge-dark badge-pill">{{ number_format($totalItemsSold) }} unit</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-dark badge-pill">{{ number_format($salesBreakdown->sum('order_count')) }} order</span>
                                    </td>
                                    <td class="text-right">
                                        <strong class="text-primary">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize top-ups table
            window.initDataTable('#topupsTable', {
                order: [[5, 'desc']], // Sort by date column (descending)
                columnDefs: [
                    { orderable: false, targets: [3, 6] } // Disable sorting on proof and action columns
                ]
            }, 0);

            // Initialize sales table
            @if(!$salesBreakdown->isEmpty())
            window.initDataTable('#salesTable', {
                order: [[3, 'desc']], // Sort by quantity sold (descending)
                pageLength: 10
            }, 0);
            @endif
        });
    </script>
@endpush
