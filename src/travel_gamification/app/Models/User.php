<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'avatar',
        'status',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Quan hệ với bảng destinations
    public function destinations()
    {
        return $this->hasMany(Destination::class, 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function missions()
    {
        return $this->belongsToMany(Mission::class, 'user_missions'); // hoặc hasMany nếu phù hợp với cấu trúc DB của bạn
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function sharedPosts()
    {
        return $this->belongsToMany(Post::class, 'shares', 'user_id', 'post_id')
            ->withPivot('is_public', 'status', 'created_at')
            ->withTimestamps();
    }

    public function rewards()
    {
        return $this->belongsToMany(Reward::class, 'user_reward')
            ->withPivot(['redeemed_at', 'delivered'])
            ->withTimestamps();
    }
    public function badges()
{
    return $this->belongsToMany(\App\Models\Badge::class, 'user_badges', 'user_id', 'badge_id');
}
public function earnedBadges()
{
    return \App\Models\Badge::whereIn('id', function($q) {
        $q->select('badge_id')
          ->from('missions')
          ->whereIn('id', function($q2) {
              $q2->select('mission_id')
                 ->from('user_missions')
                 ->where('user_id', $this->id)
                 ->where('claimed', 1);
          });
    })->get();
}
public function mainBadge()
{
    return $this->belongsTo(\App\Models\Badge::class, 'main_badge_id');
}
}
