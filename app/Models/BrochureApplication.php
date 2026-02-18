<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrochureApplication extends Model
{
    protected $fillable = ['member_id', 'name', 'email', 'status', 'sent_at'];

    protected $casts = [
        'sent_at' => 'datetime',
    ];
}
