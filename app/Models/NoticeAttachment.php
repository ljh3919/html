<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeAttachment extends Model
{
    protected $fillable = ['notice_id', 'original_name', 'stored_name', 'file_path'];

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }
}
