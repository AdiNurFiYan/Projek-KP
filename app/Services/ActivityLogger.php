<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log($description, $name = null)
    {
        $user = Auth::guard('admin')->user() ?? Auth::guard('super_admin')->user();
        
        if (!$user) {
            return null;
        }

        return Activity::create([
            'description' => $description,
            'name' => $name,
            'user_id' => $user->id,
            'role' => $user->role
        ]);
    }
}