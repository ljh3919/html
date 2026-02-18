<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceRoom extends Model
{
    protected $fillable = ['title', 'content', 'author_id'];

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function attachments()
    {
        return $this->hasMany(ReferenceAttachment::class);
    }
}
