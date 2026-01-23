<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'submission_no',
        'user_id',
        'temp_guest_id',
        'service_level_id',
        'submission_type_id',
        'label_type_id',
        'shipping_address_id',
        'guest_name',
        'status',
        'card_entry_mode',
        'total_cards',
    ];

    public function serviceLevel()
    {
        return $this->belongsTo(ServiceLevel::class);
    }

    public function cards()
    {
        return $this->hasMany(SubmissionCard::class);
    }

    public function submissionType()
    {
        return $this->belongsTo(SubmissionType::class);
    }

    public function labelType()
    {
        return $this->belongsTo(LabelType::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(ShippingAddress::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
