<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Admission extends Model
{
    use HasFactory;

    protected $table = 'admissions';

   protected $fillable = [
    'user_id', 'studentNumber','studentFirstName', 'studentLastName', 'dateOfBirth', 
    'year_level', 'previousSchool', 'parentFirstName', 'parentLastName', 
    'email', 'phone', 'address', 'city', 'state', 'zipCode', 
    'street', 'zip', 'status', 'report_card', 'birth_certificate', 
    'applicant_photo', 'father_photo', 'mother_photo', 'guardian_photo', 
    'transferee_docs'
];

public function user() {
    return $this->belongsTo(User::class);
}
public function tuition()
{
    return $this->hasOne(Tuition::class, 'studentNumber', 'studentNumber');
}
public function enrollment(): HasOne
    {
       
        return $this->hasOne(Enrollment::class, 'admission_id');
    }


}