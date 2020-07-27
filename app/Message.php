<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     public function user()
     {
         return $this->belongsTo(User::class, 'id', 'from_user_id');
     }

     public function touser()
     {
         return $this->belongsTo(User::class, 'id', 'to_user_id');
     }
}
