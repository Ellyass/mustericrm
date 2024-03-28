<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'product_buy',
        'product_sell',
        'product_description',
        'product_second_sell',
    ];
    use HasFactory;
}
