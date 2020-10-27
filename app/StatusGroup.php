<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusGroup extends Model
{
    public function statusGroupUser()
    {
        return $this->hasMany(StatusGroupUser::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
