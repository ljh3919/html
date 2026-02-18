<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = ['title', 'content', 'author_id', 'view_count'];

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function attachments()
    {
        return $this->hasMany(NoticeAttachment::class);
    }
}
