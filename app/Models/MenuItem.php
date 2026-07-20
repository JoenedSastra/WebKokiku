<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MenuItem extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'name',
        'price',
        'description',
        'image_path',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the public URL of the menu image.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image_path) {
            if (Storage::disk('public')->exists($this->image_path)) {
                return Storage::disk('public')->url($this->image_path);
            }
            if (file_exists(public_path($this->image_path))) {
                return asset($this->image_path);
            }
        }
        return asset('images/logo_kokiku.png');
    }

    /**
     * Format price as Rp xx.xxx
     */
    public function getFormattedPriceAttribute(): string
    {
        if (!$this->price) return '-';
        $numeric = preg_replace('/[^0-9]/', '', $this->price);
        return 'Rp ' . number_format((int)$numeric, 0, ',', '.');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }
}
