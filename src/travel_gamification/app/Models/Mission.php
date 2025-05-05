<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    public function badge()
    {
        return $this->belongsTo(Badge::class, 'badge_id', 'id');
    }
}
