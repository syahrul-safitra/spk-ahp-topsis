<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComparisonMatrix extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_1_id',
        'criteria_2_id',
        'nilai'
    ];
}
