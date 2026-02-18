<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dead extends Model
{
    protected $fillable = [
        'dead_code',
        'name',
        'category',
        'location_hall',
        'location_area',
        'location_row',
        'location_num',
        'death_date',
        'burial_date',
    ];

    protected $casts = [
        'death_date' => 'date',
        'burial_date' => 'date',
    ];
}
