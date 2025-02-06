<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'performed_by_id')
            ->where('performed_by_type', self::class)
            ->latest();
    }

    public function logActivity($description, $modelName = null)
    {
        return Activity::create([
            'description' => $description,
            'performed_by_type' => self::class,
            'performed_by_id' => $this->id,
            'name' => $modelName,
            'role' => $this->role,  // Tambahkan role saat logging
            'created_at' => now()
        ]);
    }
}