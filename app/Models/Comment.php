<?php

namespace App\Models;

use App\Models\User;
use App\Models\Media;
use App\Casts\CreatedAtCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Comment extends Model
{
    //
    protected $fillable = ['title', 'description', 'post_id', 'user_id'];
    protected function casts()
    {
        return [
            'created_at' => CreatedAtCast::class,
        ];
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Attribute Changer 
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => strtolower($value), //accsors 
            set: fn(string $value) => strtolower($value), //Mutator 

        );
    }
}
