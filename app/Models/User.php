<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Document;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',      // Allow name for mass assignment
        'email',     // Allow email
        'password',  // Allow password
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get all general documents uploaded by the student.
     */
// app/Models/User.php


public function documents()
{
    return $this->hasMany(Document::class);
}

    /**
     * Get all admissions of the student.
     */
    // app/Models/User.php
public function admissions() {
    return $this->hasMany(Admission::class);
}

// Access documents through their admission record
public function admissionDocuments() {
    return $this->hasManyThrough(AdmissionDocument::class, Admission::class);
}
}
