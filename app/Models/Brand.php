<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'brandname',
        'slug',
        'image',
        'status',
        'sort_order',
        'description',
    ];
}
