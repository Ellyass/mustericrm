<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $guarded = [];
    use HasFactory;

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by_user_id');
    }
}
