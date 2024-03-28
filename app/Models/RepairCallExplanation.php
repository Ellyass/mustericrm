<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairCallExplanation extends Model
{
    protected $fillable = ['repair_explanation', 'repair_customer_id'];

    use HasFactory;

    protected $table = 'repair_call_explanations';


    public function customer()
    {
        return $this->belongsTo(RepairCustomer::class, 'id');
    }


}
