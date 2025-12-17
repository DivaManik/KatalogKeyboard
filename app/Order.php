<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'keyboard_id',
        'quantity',
        'price_per_item',
        'total_price',
        'shipping_address',
        'phone',
        'status',
        'notes',
    ];

    protected $casts = [
        'price_per_item' => 'decimal:2',
        'total_price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keyboard()
    {
        return $this->belongsTo(Keyboard::class);
    }

    // Helper methods
    public function getStatusBadgeClass()
    {
        $badges = [
            'pending' => 'warning',
            'processing' => 'info',
            'shipped' => 'primary',
            'in_distribution' => 'secondary',
            'delivered' => 'success',
            'cancelled' => 'danger',
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    public function getStatusLabel()
    {
        $labels = [
            'pending' => 'Menunggu Konfirmasi',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'in_distribution' => 'Di Distribution Center',
            'delivered' => 'Terkirim',
            'cancelled' => 'Dibatalkan',
        ];

        return $labels[$this->status] ?? 'Unknown';
    }
}
