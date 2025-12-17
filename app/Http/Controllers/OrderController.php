<?php

namespace App\Http\Controllers;

use App\Order;
use App\Keyboard;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Store - Guest beli keyboard
     */
    public function store(Request $request)
    {
        $request->validate([
            'keyboard_id' => 'required|exists:keyboards,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $keyboard = Keyboard::findOrFail($request->keyboard_id);
        $user = auth()->user();

        // Check if price exists
        if (is_null($keyboard->price)) {
            return back()->with('status', 'Keyboard ini tidak tersedia untuk dibeli.')
                        ->with('status_type', 'danger');
        }

        // Calculate total
        $quantity = $request->quantity;
        $pricePerItem = $keyboard->price;
        $totalPrice = $pricePerItem * $quantity;

        // Check stock availability
        if ($keyboard->stock <= 0) {
            return back()->with('status', 'Maaf, keyboard ini sudah habis.')
                        ->with('status_type', 'danger');
        }

        if ($keyboard->stock < $quantity) {
            return back()->with('status', 'Stok tidak mencukupi. Stok tersedia: ' . $keyboard->stock . ' unit.')
                        ->with('status_type', 'danger');
        }

        // Check balance
        if ($user->balance < $totalPrice) {
            return back()->with('status', 'Saldo Anda tidak cukup. Silakan top up terlebih dahulu.')
                        ->with('status_type', 'danger');
        }

        // Check user has address and phone
        if (empty($user->address) || empty($user->phone)) {
            return back()->with('status', 'Harap lengkapi alamat dan nomor telepon di profile Anda.')
                        ->with('status_type', 'warning');
        }

        DB::beginTransaction();
        try {
            // Generate order number
            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6));

            // Create order
            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => $user->id,
                'keyboard_id' => $keyboard->id,
                'quantity' => $quantity,
                'price_per_item' => $pricePerItem,
                'total_price' => $totalPrice,
                'shipping_address' => $user->address,
                'phone' => $user->phone,
                'status' => 'pending',
            ]);

            // Deduct balance
            $user->decrement('balance', $totalPrice);

            // Reduce stock
            $keyboard->decrement('stock', $quantity);

            // Create notification
            Notification::create([
                'user_id' => $user->id,
                'type' => 'order_created',
                'title' => 'Pesanan Berhasil Dibuat',
                'message' => "Pesanan #{$orderNumber} untuk {$keyboard->name} (x{$quantity}) berhasil dibuat. Total: Rp" . number_format($totalPrice, 0, ',', '.'),
            ]);

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                           ->with('status', 'Pesanan berhasil dibuat! Menunggu konfirmasi admin.')
                           ->with('status_type', 'success');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('status', 'Terjadi kesalahan: ' . $e->getMessage())
                        ->with('status_type', 'danger');
        }
    }

    /**
     * Index - Guest lihat daftar pesanan mereka
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
                      ->with('keyboard')
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show - Detail pesanan
     */
    public function show($id)
    {
        $order = Order::with('keyboard', 'user')->findOrFail($id);

        // Check authorization
        if (!auth()->user()->isAdmin() && $order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Pass keyboard separately for backward compatibility with view
        $keyboard = $order->keyboard;

        return view('orders.show', compact('order', 'keyboard'));
    }

    /**
     * Admin Index - Admin lihat semua orders
     */
    public function adminIndex()
    {
        $orders = Order::with('keyboard', 'user')
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('orders.admin-index', compact('orders'));
    }

    /**
     * Update Status - Admin update status order
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,in_distribution,delivered,cancelled',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $order = Order::with('user')->findOrFail($id);
            $oldStatus = $order->status;
            $newStatus = $request->status;

            // Update order status
            $order->update([
                'status' => $newStatus,
                'notes' => $request->notes,
            ]);

            // Status labels
            $statusLabels = [
                'pending' => 'Menunggu Konfirmasi',
                'processing' => 'Sedang Diproses',
                'shipped' => 'Sudah Dikirim',
                'in_distribution' => 'Dalam Distribusi',
                'delivered' => 'Sudah Sampai',
                'cancelled' => 'Dibatalkan',
            ];

            // Refund balance if order is cancelled
            $notificationMessage = "Pesanan #{$order->order_number} diperbarui menjadi: {$statusLabels[$newStatus]}.";

            if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
                // Refund the total price to user balance
                $order->user->increment('balance', $order->total_price);

                // Restore stock
                $order->keyboard->increment('stock', $order->quantity);

                // Add refund info to notification
                $notificationMessage .= " Saldo sebesar Rp" . number_format($order->total_price, 0, ',', '.') . " telah dikembalikan ke akun Anda.";
            }

            // Add notes if any
            if ($request->notes) {
                $notificationMessage .= " Catatan: {$request->notes}";
            }

            // Create notification for user
            Notification::create([
                'user_id' => $order->user_id,
                'type' => 'order_status',
                'title' => 'Status Pesanan Diperbarui',
                'message' => $notificationMessage,
            ]);

            DB::commit();

            $successMessage = 'Status pesanan berhasil diperbarui.';
            if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
                $successMessage .= ' Saldo user telah dikembalikan.';
            }

            return back()->with('status', $successMessage)
                        ->with('status_type', 'success');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('status', 'Gagal memperbarui status: ' . $e->getMessage())
                        ->with('status_type', 'danger');
        }
    }
}
