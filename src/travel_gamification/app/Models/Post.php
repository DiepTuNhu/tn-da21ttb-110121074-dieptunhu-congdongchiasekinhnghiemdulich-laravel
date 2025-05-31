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
    public function utility()
    {
        return $this->belongsTo(\App\Models\Utility::class, 'utility_id');
    }
    public function likedByCurrentUser()
    {
        if (!auth()->check()) return false;
        // Nếu chưa load likes thì lấy từ DB, nếu đã load thì dùng collection
        if ($this->relationLoaded('likes')) {
            return $this->likes->where('user_id', auth()->id())->count() > 0;
        }
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function ratings()
    {
        return $this->hasMany(\App\Models\Rating::class);
    }
}
