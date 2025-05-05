<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['code', 'name', 'slug', 'region'];

    public function districts()
    {
        return $this->hasMany(District::class, 'province_id', 'id');
    }
}
