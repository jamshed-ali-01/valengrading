<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'number',
        'email',
        'address_line_1',
        'address_line_2',
        'city',
        'county',
        'post_code',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
