<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationUtility extends Model
{
    use HasFactory;

    protected $table = 'destination_utilities'; // Tên bảng

    protected $fillable = [
        'destination_id',
        'utility_id',
        'distance',
        'status',
    ];

    public $timestamps = false; // Vô hiệu hóa timestamps

    // Quan hệ với Destination
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }

    // Quan hệ với Utility
    public function utility()
    {
        return $this->belongsTo(Utility::class, 'utility_id');
    }
}
