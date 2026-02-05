<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuition extends Model
{
    use HasFactory;

    // Table name (optional if following Laravel conventions)
    protected $table = 'tuitions';

    // Mass assignable fields
    protected $fillable = [
        'studentNumber',
        'name',
        'amount',
        'status',
        'reference_number',
        'payment_method',
        'payment_proof',
        'approval_status',
    ];

    // Default values
    protected $attributes = [
        'status' => 'unpaid',           // default payment status
        'payment_method' => 'gcash',    // default payment method
        'approval_status' => 'pending', // default approval status
    ];

    /**
     * Optional: Lists of allowed enum values for validation or form options
     */
    public static $statusOptions = ['unpaid', 'paid'];
    public static $paymentMethodOptions = ['gcash', 'bank_transfer', 'cash'];
    public static $approvalStatusOptions = ['pending', 'approved', 'rejected'];
}
