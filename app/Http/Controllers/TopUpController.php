<?php

namespace App\Http\Controllers;

use App\TopUp;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TopUpController extends Controller
{
    /**
     * Guest - View their top-up history
     */
    public function index()
    {
        $topups = auth()->user()->topups()->latest()->get();
        return view('topups.index', compact('topups'));
    }

    /**
     * Guest - Show top-up request form
     */
    public function create()
    {
        return view('topups.create');
    }

    /**
     * Guest - Submit top-up request
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000|max:100000000',
            'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'amount.required' => 'Jumlah top-up harus diisi',
            'amount.min' => 'Minimal top-up adalah Rp10.000',
            'amount.max' => 'Maksimal top-up adalah Rp100.000.000',
            'proof_image.required' => 'Bukti transfer harus diupload',
            'proof_image.image' => 'File harus berupa gambar',
            'proof_image.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'proof_image.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        try {
            DB::beginTransaction();

            // Upload proof image
            $proofPath = $request->file('proof_image')->store('topup-proofs', 'public');

            // Create top-up request
            $topup = TopUp::create([
                'user_id' => auth()->id(),
                'amount' => $request->amount,
                'status' => 'pending',
                'proof_image' => $proofPath,
            ]);

            // Create notification for user
            Notification::create([
                'user_id' => auth()->id(),
                'type' => 'topup_requested',
                'title' => 'Permintaan Top-Up Dikirim',
                'message' => 'Permintaan top-up sebesar Rp' . number_format($request->amount, 0, ',', '.') . ' telah dikirim. Menunggu persetujuan admin.',
            ]);

            DB::commit();

            return redirect()->route('topups.index')
                ->with('status', 'Permintaan top-up berhasil dikirim. Silakan tunggu konfirmasi admin.')
                ->with('status_type', 'success');
        } catch (\Exception $e) {
            DB::rollBack();

            // Delete uploaded image if exists
            if (isset($proofPath)) {
                Storage::disk('public')->delete($proofPath);
            }

            return back()
                ->withInput()
                ->with('status', 'Gagal mengirim permintaan top-up: ' . $e->getMessage())
                ->with('status_type', 'danger');
        }
    }

    /**
     * Admin - View all top-up requests
     */
    public function adminIndex()
    {
        $topups = TopUp::with(['user', 'processedBy'])
            ->latest()
            ->get();

        // Calculate revenue and items sold from orders
        $totalRevenue = \App\Order::whereIn('status', ['processing', 'shipped', 'in_distribution', 'delivered'])
            ->sum('total_price');

        $totalItemsSold = \App\Order::whereIn('status', ['processing', 'shipped', 'in_distribution', 'delivered'])
            ->sum('quantity');

        // Get sales breakdown by keyboard
        $salesBreakdown = \App\Order::with('keyboard')
            ->whereIn('status', ['processing', 'shipped', 'in_distribution', 'delivered'])
            ->selectRaw('keyboard_id, SUM(quantity) as total_quantity, SUM(total_price) as total_revenue, COUNT(*) as order_count')
            ->groupBy('keyboard_id')
            ->orderByDesc('total_quantity')
            ->get();

        return view('topups.admin-index', compact('topups', 'totalRevenue', 'totalItemsSold', 'salesBreakdown'));
    }

    /**
     * Admin - Approve top-up request
     */
    public function approve(Request $request, $id)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            $topup = TopUp::findOrFail($id);

            // Check if already processed
            if ($topup->status !== 'pending') {
                return back()
                    ->with('status', 'Top-up ini sudah diproses sebelumnya.')
                    ->with('status_type', 'warning');
            }

            // Update top-up status
            $topup->update([
                'status' => 'approved',
                'processed_by' => auth()->id(),
                'reason' => $request->reason,
            ]);

            // Add balance to user
            $topup->user->increment('balance', $topup->amount);

            // Create notification for user
            Notification::create([
                'user_id' => $topup->user_id,
                'type' => 'topup_approved',
                'title' => 'Top-Up Disetujui',
                'message' => 'Permintaan top-up sebesar Rp' . number_format($topup->amount, 0, ',', '.') . ' telah disetujui. Saldo Anda telah ditambahkan.',
            ]);

            DB::commit();

            return back()
                ->with('status', 'Top-up berhasil disetujui. Saldo user telah ditambahkan.')
                ->with('status_type', 'success');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->with('status', 'Gagal menyetujui top-up: ' . $e->getMessage())
                ->with('status_type', 'danger');
        }
    }

    /**
     * Admin - Reject top-up request
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ], [
            'reason.required' => 'Alasan penolakan harus diisi',
            'reason.max' => 'Alasan penolakan maksimal 500 karakter',
        ]);

        try {
            DB::beginTransaction();

            $topup = TopUp::findOrFail($id);

            // Check if already processed
            if ($topup->status !== 'pending') {
                return back()
                    ->with('status', 'Top-up ini sudah diproses sebelumnya.')
                    ->with('status_type', 'warning');
            }

            // Update top-up status
            $topup->update([
                'status' => 'rejected',
                'processed_by' => auth()->id(),
                'reason' => $request->reason,
            ]);

            // Create notification for user
            Notification::create([
                'user_id' => $topup->user_id,
                'type' => 'topup_rejected',
                'title' => 'Top-Up Ditolak',
                'message' => 'Permintaan top-up sebesar Rp' . number_format($topup->amount, 0, ',', '.') . ' ditolak. Alasan: ' . $request->reason,
            ]);

            DB::commit();

            return back()
                ->with('status', 'Top-up berhasil ditolak.')
                ->with('status_type', 'success');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->with('status', 'Gagal menolak top-up: ' . $e->getMessage())
                ->with('status_type', 'danger');
        }
    }
}
