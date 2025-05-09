<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityType extends Model
{
    use HasFactory;

    public function utilities()
    {
        return $this->hasMany(Utility::class, 'utility_type_id');
    }
}
