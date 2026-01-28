<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowcaseCard extends Model
{
    protected $fillable = [
        'title',
        'image_path',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}