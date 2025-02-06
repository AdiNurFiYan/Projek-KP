<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'office_information';

    protected $fillable = [
        'content',           // from about_histories
        'office_photo_path',
        'embed_map_code',
        'address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}