<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')->withTimestamps();
    }

    public function sizes()
    {
        return $this->belongsToMany('App\Models\Size')->withTimestamps();
    }

    public function storages()
    {
        return $this->belongsToMany('App\Models\Storage')->withPivot('quantity', 'limit')->withTimestamps();
    }

    public function providers()
    {
        return $this->belongsToMany('App\Models\Provider')->withTimestamps();
    }

    public function transactions()
    {
        return $this->belongsToMany('App\Models\Transaction')->withPivot('quantity', 'subtotal')->withTimestamps();
    }
}
