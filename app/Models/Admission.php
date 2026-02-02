<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $table = 'admissions';

   protected $fillable = [
    'user_id', 'studentFirstName', 'studentLastName', 'dateOfBirth', 
    'year_level', 'previousSchool', 'parentFirstName', 'parentLastName', 
    'email', 'phone', 'address', 'city', 'state', 'zipCode', 
    'street', 'zip', 'status', 'report_card', 'birth_certificate', 
    'applicant_photo', 'father_photo', 'mother_photo', 'guardian_photo', 
    'transferee_docs'
];
}