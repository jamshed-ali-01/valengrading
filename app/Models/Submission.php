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
        'shipping_amount',
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

    public function getTotalCostAttribute()
    {
        $total = 0;
        if ($this->card_entry_mode === 'detailed') {
            foreach ($this->cards as $card) {
                $labelCost = $card->labelType?->price_adjustment ?? 0;
                $total += ($this->serviceLevel->price_per_card + $labelCost) * ($card->qty ?? 1);
            }
        } else {
            $labelCost = $this->labelType?->price_adjustment ?? 0;
            $total = ($this->serviceLevel->price_per_card + $labelCost) * ($this->total_cards ?? 0);
        }
        return $total + ($this->shipping_amount ?? 0);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
