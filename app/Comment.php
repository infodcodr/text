<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [ 'content', 'is_draft', 'is_active', 'user_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function favourite()
    {
        return $this->morphMany(Favourite::class,'type');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
