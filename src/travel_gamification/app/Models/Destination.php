<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'travel_type_id',
        'address',
        'latitude',
        'longitude',
        'status',
        'highlights',
        'best_time',
        'local_cuisine',
        'transportation',
        'user_id',
    ];

    // Quan hệ với bảng travel_types
    public function travel_types()
    {
        return $this->belongsTo(TravelType::class, 'travel_type_id');
    }

    // Quan hệ với bảng users
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
