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
}
