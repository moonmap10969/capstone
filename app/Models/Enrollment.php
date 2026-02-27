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

    /**
     * Relationship with Admission to get student names.
     */
    public function admission()
    {
        return $this->belongsTo(Admission::class, 'studentNumber', 'studentNumber');
    }

    /**
     * Relationship with Section.
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'section_id');
    }

    /**
     * Relationship with ClassRecord (Summarized Final Grades).
     * studentNumber in ClassRecord refers to the ID of this Enrollment.
     */
    public function classRecord()
    {
        return $this->hasOne(ClassRecord::class, 'studentNumber', 'id');
    }

    /**
     * Relationship with individual Student Grades (Raw Scores).
     */
    public function grades()
    {
        return $this->hasMany(StudentGrade::class, 'enrollment_id', 'id');
    }
}