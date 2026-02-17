<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Enrollment extends Model
{
    use HasFactory;
protected $fillable = [
    'studentNumber', 
    'section_id', 
    'shift', 
    'year_level', 
    'school_year', 
    'status'
];
public function admission()
{
    // Match this to your foreign key, likely admission_id or studentNumber
    return $this->belongsTo(Admission::class, 'studentNumber', 'studentNumber');
}

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
