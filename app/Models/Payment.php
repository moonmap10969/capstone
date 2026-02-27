<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentNumber',
        'amount',
        'payment_method',
        'status',
        'approval_status',
        'reference_number',
        'payment_proof'
    ];

    protected $attributes = [
        'status' => 'completed',
        'approval_status' => 'approved',
    ];

    /**
     * Relationship: Payment belongs to Tuition
     */
    public function tuition()
    {
        return $this->belongsTo(Tuition::class, 'studentNumber', 'studentNumber');
    }
}