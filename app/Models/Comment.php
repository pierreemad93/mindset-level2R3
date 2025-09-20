<?php

namespace App\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['title' , 'description' , 'post_id'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
