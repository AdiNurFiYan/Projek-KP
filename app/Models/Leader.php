<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Leader extends Model
{
    protected $fillable = [
        'name',
        'position', 
        'photo_path',
        'period_start',
        'period_end',
        'is_active'
    ];

    protected $casts = [
        'period_start' => 'integer',
        'period_end' => 'integer',
        'is_active' => 'boolean',
    ];

    // Accessors & Mutators jika diperlukan
    public function getPhotoUrlAttribute()
    {
        if ($this->photo_path) {
            return Storage::url($this->photo_path);
        }
        return null;
    }
}