<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuition extends Model
{
    use HasFactory;

    protected $primaryKey = 'studentNumber';
    protected $table = 'tuitions';

   protected $fillable = [
    'studentNumber',
    'name',
    'year_level',
    'tuition_fee',
    'misc_fees',
    'amount',
    'balance',
    'reference_number',
    'status',
    'payment_schedule',
    'umc_affiliation',
    'sibling_order',
    'grade_level',
    'payment_method',
    'approval_status',
    'payment_type',
    'payment_proof'
];

    public function admission()
    {
        return $this->belongsTo(Admission::class, 'studentNumber', 'studentNumber');
    }
public function payments()
{
    return $this->hasMany(Payment::class, 'studentNumber', 'studentNumber');
}
}