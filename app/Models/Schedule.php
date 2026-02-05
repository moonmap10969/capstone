<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'teacher',
        'day_of_week',
        'start_time',
        'end_time',
        'room',
        'year_level',
        'section',
    ];
}
