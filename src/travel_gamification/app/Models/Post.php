<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'address', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    
    public function destination()
    {
        return $this->belongsTo(\App\Models\Destination::class, 'destination_id');
    }

    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }
}
