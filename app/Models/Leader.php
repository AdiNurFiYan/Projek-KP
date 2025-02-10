<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Leader extends Model
{
    use SoftDeletes;

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

    // Validasi custom untuk periode
    public static function periodRules()
    {
        return [
            'period_start' => ['required', 'integer', 'min:1500', 'max:2500'],
            'period_end' => ['required', 'integer', 'min:1500', 'max:2500', 'gte:period_start'],
        ];
    }

    // Accessor untuk URL foto
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo_path ? Storage::url($this->photo_path) : null;
    }

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk mengurutkan berdasarkan periode
    public function scopeOrderByPeriod($query)
    {
        return $query->orderBy('period_start', 'desc');
    }
}
