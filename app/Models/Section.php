<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'section_id',
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
}