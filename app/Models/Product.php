<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'stock_quantity', 'description'];

    public const LOW_STOVCK_THRESHOLD = 5;
}
