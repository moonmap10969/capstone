<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file_path',
        'user_id',
        'admission_id',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function admission()
    {
        return $this->belongsTo(\App\Models\Admission::class);
    }
}
