<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'table_number',
        'phone',
        'status',
        'notes',
        'total',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format((int) $this->total, 0, ',', '.');
    }

    /** Label & warna badge yang cocok dipakai langsung di Blade. */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'menunggu'   => 'Menunggu',
            'diproses'   => 'Diproses',
            'selesai'    => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default      => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'menunggu'   => '#fbbf24', // gold
            'diproses'   => '#60a5fa', // blue
            'selesai'    => '#4ade80', // green
            'dibatalkan' => '#ff7a7a', // red
            default      => '#8892a8',
        };
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}