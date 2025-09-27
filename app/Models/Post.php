<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['title', 'description', 'user_id'];
    public function media()
    {
        return $this->MorphMany(Media::class, 'mediable');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
