<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
            if ($request->is('super-admin/*')) {
                return route('super-admin.login');
            }
            return route('dashboard'); // ubah dari 'login' ke 'dashboard'
        }
        return null;
    }
}