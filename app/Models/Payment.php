<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentNumber',
        'name',
        'tuition_fee',
        'misc_fees',
        'amount',
        'payment_method',
        'status',
        'approval_status',
        'reference_number',
        'payment_proof',
        'payment_type',
        'id',
        
    ];

    // Optional defaults
    protected $attributes = [
        'status' => 'pending',
        'approval_status' => 'pending',
    ];
}