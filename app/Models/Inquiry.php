<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = ['username', 'email', 'title', 'content', 'status'];

    public function reply()
    {
        return $this->hasOne(InquiryReply::class);
    }
}
