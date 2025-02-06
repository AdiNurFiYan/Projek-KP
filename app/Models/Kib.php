<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Kib extends Model
{
    protected $fillable = [
        'nama_dokumen',
        'file_path',
        'kib_type_id'
    ];

    // Accessor untuk mendapatkan URL file
    public function getFileUrlAttribute()
    {
        // Pastikan file_path tidak kosong
        if (empty($this->file_path)) {
            return null;
        }

        // Menggunakan Storage::url untuk mendapatkan URL publik
        return Storage::url($this->file_path);
    }

    // Relasi ke KibType
    public function kibType()
    {
        return $this->belongsTo(KibType::class);
    }
}