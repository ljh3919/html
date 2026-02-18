<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceAttachment extends Model
{
    protected $fillable = ['reference_room_id', 'original_name', 'stored_name', 'file_path'];

    public function referenceRoom()
    {
        return $this->belongsTo(ReferenceRoom::class);
    }
}
