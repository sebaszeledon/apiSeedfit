<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
