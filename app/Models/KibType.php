<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class KibType extends Model
{
    use HasFactory;
    
    protected $table = 'kib_types';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
    ];

    protected $appends = [
        'image_url',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($kibType) {
            if ($kibType->gambar && Storage::disk('public')->exists($kibType->gambar)) {
                Storage::disk('public')->delete($kibType->gambar);
            }

            $kibType->detailKibs->each(function ($kib) {
                if ($kib->file_path && Storage::disk('public')->exists($kib->file_path)) {
                    Storage::disk('public')->delete($kib->file_path);
                }
                $kib->delete();
            });
        });
    }

    public function detailKibs(): HasMany
    {
        return $this->hasMany(Kib::class, 'kib_type_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->gambar 
            ? Storage::disk('public')->url($this->gambar)
            : null;
    }

    public function deleteImage(): void
    {
        if ($this->gambar && Storage::disk('public')->exists($this->gambar)) {
            Storage::disk('public')->delete($this->gambar);
            $this->update(['gambar' => null]);
        }
    }
}