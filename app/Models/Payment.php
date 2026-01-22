<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 
        'student_number', 
        'reference_number', 
        'description', 
        'amount', 
        'payment_method',
        'receipt_path'
    ];
}
