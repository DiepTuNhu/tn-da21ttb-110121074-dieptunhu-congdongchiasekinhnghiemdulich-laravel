<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'post_id', 'content', 'parent_comment_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class, 'comment_id');
    }
    
    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class, 'post_id');
    }
}
