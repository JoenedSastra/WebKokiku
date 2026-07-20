<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryItem extends Model
{
    protected $table = 'gallery_items';

    protected $fillable = [
        'image_path',
        'caption',
        'sort_order',
    ];

    /**
     * Get the public URL of the gallery image.
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
        return 'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=600&q=80';
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }
}
