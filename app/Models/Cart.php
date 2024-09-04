<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function cartPositions(): HasMany
    {
        return $this->hasMany(CartPosition::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
    
    public function complete()
    {
        $this->update(['is_completed' => true]);
        return $this;
    }
}
