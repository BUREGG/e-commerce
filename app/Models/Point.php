<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'address', 'city', 'province', 'postcode', 'street', 'building_number',
        'latitude', 'longitude', 'location_type', 'opening_hours', 'functions', 'user_id'
    ];
}
