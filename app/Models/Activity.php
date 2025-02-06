<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'description',
        'name',
        'user_id',
        'role'
    ];

    public function user()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }

    public static function getRecentActivities($role = null)
    {
        $query = self::with('user')->latest();
        
        if ($role === 'admin') {
            // Admin hanya melihat aktivitasnya sendiri
            $query->where('user_id', auth()->id())
                  ->where('role', 'admin');
        } elseif ($role === 'super_admin') {
            // Super admin melihat semua aktivitas
            $query->whereIn('role', ['admin', 'super_admin']);
        }

        return $query->take(10)->get();
    }
}