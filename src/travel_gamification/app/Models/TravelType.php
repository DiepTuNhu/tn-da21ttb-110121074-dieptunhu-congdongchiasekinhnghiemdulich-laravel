<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelType extends Model
{
    use HasFactory;

    protected $table = 'travel_types'; // Đặt tên bảng chính xác
    protected $fillable = ['name'];

    // Quan hệ với bảng destinations
    public function destinations()
    {
        return $this->hasMany(Destination::class, 'travel_type_id');
    }
}
