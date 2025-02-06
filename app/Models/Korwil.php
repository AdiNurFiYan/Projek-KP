<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Korwil extends Model
{
    use HasFactory;

    protected $table = 'korwils';
    
    protected $fillable = [
        'nama',
        'gambar'
    ];

    public function getImageUrlAttribute()
    {
        return $this->gambar ? Storage::disk('public')->url($this->gambar) : asset('images/default-school.png');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d F Y H:i');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($korwil) {
            if ($korwil->gambar && Storage::disk('public')->exists($korwil->gambar)) {
                Storage::disk('public')->delete($korwil->gambar);
            }
        });
    }

    public function sekolahs()
    {
        return $this->hasMany(Sekolah::class);
    }
}