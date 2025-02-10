<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class About extends Model
{
    use SoftDeletes;

    protected $table = 'office_information';

    protected $fillable = [
        'content',
        'office_photo_path',
        'embed_map_code',
        'address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope untuk mengambil data aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor untuk URL foto kantor
    public function getOfficePhotoUrlAttribute(): ?string
    {
        return $this->office_photo_path ? Storage::url($this->office_photo_path) : null;
    }
}
