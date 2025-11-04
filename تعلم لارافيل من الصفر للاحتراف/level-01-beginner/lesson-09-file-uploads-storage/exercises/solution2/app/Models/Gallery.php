<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'description',
        'original_path',
        'medium_path',
        'thumbnail_path',
        'filename',
        'size',
        'mime_type',
    ];

    /**
     * الحصول على URL الصورة الأصلية
     * Get original image URL
     */
    public function getOriginalUrlAttribute()
    {
        return asset('storage/' . $this->original_path);
    }

    /**
     * الحصول على URL الصورة المتوسطة
     * Get medium image URL
     */
    public function getMediumUrlAttribute()
    {
        return $this->medium_path ? asset('storage/' . $this->medium_path) : $this->original_url;
    }

    /**
     * الحصول على URL الصورة المصغرة
     * Get thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail_path ? asset('storage/' . $this->thumbnail_path) : $this->original_url;
    }

    /**
     * حذف جميع صور المعرض عند الحذف
     * Delete all gallery images when deleting
     */
    protected static function booted()
    {
        static::deleting(function ($gallery) {
            // حذف جميع الصور
            if ($gallery->original_path) {
                Storage::disk('public')->delete($gallery->original_path);
            }
            if ($gallery->medium_path) {
                Storage::disk('public')->delete($gallery->medium_path);
            }
            if ($gallery->thumbnail_path) {
                Storage::disk('public')->delete($gallery->thumbnail_path);
            }
        });
    }
}
