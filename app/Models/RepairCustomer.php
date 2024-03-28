<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairCustomer extends Model
{
    protected $table = 'repair_customers';
    protected $guarded = [];
    protected $fillable = ['repair_customer_name','repair_customer_date', 'repair_customer_phone'];
    use HasFactory;


    public function repair_types()
    {
        return $this->hasMany('App\Models\RepairType');
    }

    public function repair_pieces()
    {
        return $this->hasMany('App\Models\RepairPiece');
    }
}
