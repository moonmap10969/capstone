<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuition extends Model
{
    use HasFactory;

     protected $table = 'tuitions';

    protected $fillable = [
        'enrollment_id',
        'studentNumber',
        'academic_year_id', // Added for year tracking
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

    protected static function booted()
    {
        // Automatically set balance equal to amount when assessment is first created
        static::creating(function ($tuition) {
            if (empty($tuition->balance)) {
                $tuition->balance = $tuition->amount;
            }
        });
    }

    public function admission()
    {
        return $this->belongsTo(Admission::class, 'studentNumber', 'studentNumber');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'tuition_id', 'id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id', 'id');
    }
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id', 'id');
    }
}