<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancel extends Model
{
    protected $table = 'cancels';
    protected $fillable = ['customer_id','customer_cancel'];
    use HasFactory;
}
