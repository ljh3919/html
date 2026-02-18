<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $fillable = ['title', 'content', 'start_at', 'end_at', 'is_visible'];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_visible' => 'boolean',
    ];

    public function getStatusAttribute()
    {
        $now = now();

        if ($now->lt($this->start_at)) {
            return '사용대기';
        }

        if ($now->gt($this->end_at)) {
            return '종료';
        }

        return '진행중';
    }
}
