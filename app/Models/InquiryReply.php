<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryReply extends Model
{
    protected $fillable = ['inquiry_id', 'admin_id', 'title', 'content'];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function attachments()
    {
        return $this->hasMany(InquiryAttachment::class);
    }
}
