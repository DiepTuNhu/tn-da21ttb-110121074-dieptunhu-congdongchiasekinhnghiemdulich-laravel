<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'cost_points', 'type', 'stock', 'image', 'active'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_reward')
            ->withPivot(['id', 'redeemed_at', 'delivered', 'user_confirmed', 'receiver_name', 'receiver_phone', 'receiver_address', 'shipping_note'])
            ->withTimestamps();
    }
}
