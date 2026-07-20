<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'item_type',
        'item_id',
        'item_name',
        'price',
        'qty',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getSubtotalAttribute(): int
    {
        return (int) $this->price * (int) $this->qty;
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }
}