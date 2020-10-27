<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusGroupUser extends Model
{
    public function statusGroup()
    {
        return $this->belongsTo(StatusGroup::class);
    }
}
