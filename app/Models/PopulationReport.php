<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopulationReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'brand',
        'set_name',
        'card_number',
        'title',
        'rarity',
        'grade_1',
        'grade_2',
        'grade_3',
        'grade_4',
        'grade_5',
        'grade_6',
        'grade_7',
        'grade_8',
        'grade_9',
        'grade_10',
        'total',
    ];
}
