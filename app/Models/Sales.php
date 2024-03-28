<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{

    protected $table = 'sales';
    protected $fillable = [
        'customer_id',
        'product_id',
        'product_buy', 'product_sell',
        'product_second_sell',
        'sales_buy',
        'sales_second_sell',
        'sales_sell'
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }










    //    public function calculateEarnings()
//    {
//        $sales_pcb = $this->sales_pcb;
//        $sales_point= $this->sales_buy * $sales_pcb;
//
//
//        if ($this->sales_second_sell) {
//            $sales_earning = $sales_point - ($this->sales_second_sell * $sales_pcb);
//        } else {
//            $sales_earning = $sales_point - ($this->sales_sell * $sales_pcb);
//        }
//
//        return $sales_earning;
//    }
    use HasFactory;
}

