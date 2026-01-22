<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Admission extends Model
    {
        protected $fillable = [
        'user_id', 
        'application_id',
        'student_first_name',
        'student_last_name',
        'date_of_birth',
        'grade_applied',
        'parent_first_name',
        'parent_last_name',
        'email',
        'phone',
        'street',
        'city',
        'state',
        'zip',
        'additional_info',
        'birth_certificate',
        'immunization_records',
        'report_card',      
        'good_moral',       
        'student_number',   
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admission()
{
    return $this->hasOne(Admission::class);
}
    }
