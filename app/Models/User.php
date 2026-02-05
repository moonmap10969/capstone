<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'studentNumber', 'year_level', 'is_approved',
    ];

    protected $hidden = ['password', 'remember_token'];

    // Helper to check for registrar role
    public function isRegistrar(): bool
    {
        return $this->role === 'registrar';
    }

    public function admission(): HasOne {
        return $this->hasOne(Admission::class);
    }

    public function documents(): HasMany {
        return $this->hasMany(Document::class, 'user_id');
    }

    public function admissions(): HasMany {
        return $this->hasMany(Admission::class);
    }

    public function payments(): HasMany {
        return $this->hasMany(Payment::class);
    }
}