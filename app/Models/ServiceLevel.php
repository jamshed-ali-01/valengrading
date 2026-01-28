<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceLevel extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceLevelFactory> */
    use HasFactory;

    protected $fillable = [
        'submission_type_id',
        'name',
        'delivery_time',
        'min_submission',
        'price_per_card',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price_per_card' => 'decimal:2',
            'min_submission' => 'integer',
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function getMinSubmissionDisplayAttribute(): ?string
    {
        if ($this->min_submission === null) {
            return null;
        }

        return "Minimum Submission {$this->min_submission} Cards*";
    }

    // Check if has minimum submission
    public function getHasMinSubmissionAttribute(): bool
    {
        return $this->min_submission !== null;
    }

    public function submissionType()
    {
        return $this->belongsTo(SubmissionType::class);
    }
}
