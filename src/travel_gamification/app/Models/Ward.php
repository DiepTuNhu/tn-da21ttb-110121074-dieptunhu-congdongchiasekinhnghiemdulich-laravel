<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $fillable = ['code', 'name', 'slug', 'district_id'];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
