<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionCard extends Model
{
    protected $fillable = [
        'submission_id',
        'qty',
        'title',
        'set_name',
        'year',
        'card_number',
        'lang',
        'notes',
        'label_type_id',
        'status',
        'admin_notes',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function labelType()
    {
        return $this->belongsTo(LabelType::class);
    }
}
