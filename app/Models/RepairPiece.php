<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairPiece extends Model
{
    use HasFactory;
    protected $table = 'repair_customer_pieces';
    protected $guarded =[];
}
