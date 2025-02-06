<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolahs';
    
    protected $fillable = [
        'korwil_id',
        'jenis',
        'nama',
        'kapsek',
        'npsn',
        'akreditasi',
        'kurikulum',
        'alamat',
        'status_tanah',
        'no_sertifikat',
        'denah',
        'foto',
        'laporan_asset'
    ];
    
    protected $casts = [
        'foto' => 'array'
    ];

    public function sarpras()
    {
        return $this->hasOne(Sarpras::class);
    }

    public function korwil()
    {
        return $this->belongsTo(Korwil::class);
    }
}