<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSarpras extends Model
{
   use HasFactory;

   // Konstanta untuk jenis ruang
   const JENIS_RUANG = [
       'ruang_kelas' => 'Ruang Kelas',
       'ruang_perpus' => 'Ruang Perpustakaan', 
       'ruang_lab' => 'Ruang Laboratorium',
       'ruang_praktik' => 'Ruang Praktik',
       'ruang_pimpinan' => 'Ruang Pimpinan',
       'ruang_guru' => 'Ruang Guru',
       'ruang_ibadah' => 'Ruang Ibadah',
       'uks' => 'UKS',
       'toilet' => 'Toilet',
       'gudang' => 'Gudang',
       'sirkulasi' => 'Sirkulasi',
       'olahraga' => 'Olahraga',
       'tu' => 'Tata Usaha',
       'konseling' => 'Ruang Konseling',
       'osis' => 'Ruang OSIS',
       'bangunan' => 'Bangunan',
       'dinas' => 'Ruang Dinas'
   ];

   // Konstanta untuk kondisi
   const KONDISI = [
       'Baik',
       'Rusak Ringan', 
       'Rusak Sedang',
       'Rusak Berat'
   ];

   // Nama tabel
   protected $table = 'detail_sarpras';

   // Fillable fields
   protected $fillable = [
       'sarpras_id',
       'jenis_ruang',
       'luas',
       'kondisi', 
       'foto',
       'keterangan'
   ];

   // Type casting
   protected $casts = [
       'foto' => 'array',
       'luas' => 'float'
   ];

   // Dates
   protected $dates = [
       'created_at',
       'updated_at'
   ];

   /**
    * Get the sarpras that owns the detail.
    */
   public function sarpras()
   {
       return $this->belongsTo(Sarpras::class, 'sarpras_id');
   }

   /**
    * Get the formatted jenis ruang attribute.
    *
    * @return string
    */
   public function getFormattedJenisRuangAttribute()
   {
       return self::JENIS_RUANG[$this->jenis_ruang] ?? ucwords(str_replace('_', ' ', $this->jenis_ruang));
   }

   /**
    * Get the kondisi color attribute.
    *
    * @return string
    */
   public function getKondisiColorAttribute()
   {
       return match($this->kondisi) {
           'Baik' => 'green',
           'Rusak Ringan' => 'yellow',
           'Rusak Sedang' => 'orange', 
           'Rusak Berat' => 'red',
           default => 'gray'
       };
   }

   /**
    * Get the kondisi badge class attribute.
    *
    * @return string
    */
   public function getKondisiBadgeClassAttribute()
   {
       return match($this->kondisi) {
           'Baik' => 'bg-green-100 text-green-800',
           'Rusak Ringan' => 'bg-yellow-100 text-yellow-800',
           'Rusak Sedang' => 'bg-orange-100 text-orange-800',
           'Rusak Berat' => 'bg-red-100 text-red-800',
           default => 'bg-gray-100 text-gray-800'
       };
   }

   /**
    * Scope a query to only include records with specific kondisi.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @param  string  $kondisi
    * @return \Illuminate\Database\Eloquent\Builder
    */
   public function scopeWithKondisi($query, $kondisi)
   {
       return $query->where('kondisi', $kondisi);
   }

   /**
    * Scope a query to only include records with specific jenis ruang.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @param  string  $jenisRuang
    * @return \Illuminate\Database\Eloquent\Builder
    */
   public function scopeWithJenisRuang($query, $jenisRuang) 
   {
       return $query->where('jenis_ruang', $jenisRuang);
   }

   /**
    * Get foto url attribute.
    * 
    * @return array
    */
   public function getFotoUrlsAttribute()
   {
       if (!$this->foto) {
           return [];
       }

       return array_map(function($foto) {
           return asset('storage/' . $foto);
       }, $this->foto);
   }

   /**
    * Check if detail has photos.
    *
    * @return bool
    */
    public function getPhotoCountAttribute()
{
    if (empty($this->foto)) {
        return 0;
    }
    // Pastikan $this->foto adalah array sebelum di-count
    return is_array($this->foto) ? count($this->foto) : 0;
}
}