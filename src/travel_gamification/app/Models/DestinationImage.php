<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationImage extends Model
{
    use HasFactory;
    protected $table = 'destination_images';
    protected $fillable = [
        'destination_id',
        'name',
        'image1',
        'images', // or any other fields you want to allow for mass assignment
        'status',
        'image_url',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
}
