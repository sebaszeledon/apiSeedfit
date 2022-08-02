<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withTimestamps();
    }

    public function agents()
    {
        return $this->hasMany('App\Models\Agent');
    }
}
