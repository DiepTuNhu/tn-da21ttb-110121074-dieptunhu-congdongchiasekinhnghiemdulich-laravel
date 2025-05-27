<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    use HasFactory;

    public function utility_types()
    {
        return $this->belongsTo(UtilityType::class, 'utility_type_id');
    }
    public function nearbyDestinations()
    {
        return $this->belongsToMany(
            \App\Models\Destination::class,
            'destination_utilities',
            'utility_id',
            'destination_id'
        )->withPivot('distance');
    }
    public function destinationUtilities() {
        return $this->hasMany(\App\Models\DestinationUtility::class, 'utility_id');
    }
}
