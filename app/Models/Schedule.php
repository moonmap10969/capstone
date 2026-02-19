<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // Disable auto-incrementing since your table lacks it
    public $incrementing = false;

    protected $fillable = [
        'id', // Required to save manual IDs
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