<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsToMany(Post::class,'timeline_post','timeline','type_id');
    }
    
    public function store($model)
    {
        $newPost = New TimelinePost();
        $newPost->type_id=$model->id;
        $newPost->timeline=$this->id;
        $newPost->type_type= get_class($model);
        $newPost->save();
    }
}
