<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartPositionInRealisation extends Model
{
    protected $table = 'cart_positions_in_realisation';

    use HasFactory;
    public function cart()
    {
        return $this->belongsTo(CartInRealisation::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
