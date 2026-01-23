<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelType extends Model
{
    /** @use HasFactory<\Database\Factories\LabelTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price_adjustment',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price_adjustment' => 'decimal:2',
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    // Helper method to get display price
    public function getDisplayPriceAttribute(): string
    {
        if ($this->price_adjustment == 0) {
            return 'Free';
        }

        if ($this->price_adjustment > 0) {
            return '+€'.number_format($this->price_adjustment, 2);
        }

        return '-€'.number_format(abs($this->price_adjustment), 2);
    }
}
