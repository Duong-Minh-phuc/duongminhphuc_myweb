<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'productname',
        'slug',
        'price',
        'pricediscount',
        'image',
        'description',
        'status',
        'brandid',
        'cateid',
    ];
}
