<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionType extends Model
{
    /** @use HasFactory<\Database\Factories\SubmissionTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'description',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    // Helper method to get display title
    public function getDisplayTitleAttribute(): string
    {
        return $this->title ?? $this->name;
    }
}
