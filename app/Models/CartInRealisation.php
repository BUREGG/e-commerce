<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CartInRealisation extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartPositionsInRealisation()
    {
        return $this->hasMany(CartPositionInRealisation::class);
    }
    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
