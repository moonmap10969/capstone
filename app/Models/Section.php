<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public $timestamps = false;

    // Fixed: Explicitly define the custom primary key to prevent Laravel from looking for 'id'
    protected $primaryKey = 'section_id';

    // If your section_id is not an auto-incrementing integer (e.g., a string), uncomment the line below:
    // public $incrementing = false;

    protected $fillable = [
        'section_id',
        'name',
        'capacity',
        'year_level',
    ];

    /**
     * Automatically format year_level to 'grade10' format.
     */
    public function setYearLevelAttribute($value)
    {
        // strtolower makes it lowercase, str_replace removes spaces
        $this->attributes['year_level'] = strtolower(str_replace(' ', '', $value));
    }

    /**
     * Relationship to Enrollments.
     */
    public function enrollments()
    {
        // format: hasMany(RelatedModel, foreign_key_on_enrollments, local_key_on_sections)
        return $this->hasMany(Enrollment::class, 'section_id', 'section_id');
    }
}