<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['timeline_id', 'type', 'content', 'user_id', 'is_draft'];

    public function fullcomment()
    {
        return $this->belongsToMany(Comment::class,'comment_post');
    }

    public function comment()
    {
        return $this->fullcomment()->withCount('favourite');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Images::class);
    }

    public function favourite()
    {
        return $this->morphMany(Favourite::class,'type');
    }

    public function favouriteUser()
    {
        return $this->favourite()->select(['id', 'user_id']);
    }

    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }

}
