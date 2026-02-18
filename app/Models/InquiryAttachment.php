<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryAttachment extends Model
{
    protected $fillable = ['inquiry_reply_id', 'original_name', 'stored_name', 'file_path'];

    public function inquiryReply()
    {
        return $this->belongsTo(InquiryReply::class);
    }
}
