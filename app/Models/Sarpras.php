<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sarpras extends Model
{
    protected $fillable = [
        'sekolah_id',
        'ruang_kelas',
        'ruang_perpus',
        'ruang_lab',
        'ruang_praktik',
        'ruang_pimpinan',
        'ruang_guru',
        'ruang_ibadah',
        'uks',
        'toilet',
        'gudang',
        'sirkulasi',
        'olahraga',
        'tu',
        'konseling',
        'osis',
        'bangunan',
        'dinas'
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
    public function detailSarpras()
    {
        return $this->hasMany(DetailSarpras::class, 'sarpras_id');
    }
}