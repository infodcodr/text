<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimelinePost extends Model
{
    protected $table = 'timeline_post';

    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }
    public function post()
    {
        return $this->morphTo('type');
    }
}
