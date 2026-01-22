<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
   public function rules(): array
{
    return [
        'username' => ['required', 'string'], // Remove 'email' validation
        'password' => ['required', 'string'],
    ];
}

public function authenticate(): void
{
    $this->ensureIsNotRateLimited();

    // Only call this once
    if (! Auth::attempt($this->only('username', 'password'), $this->boolean('remember'))) {
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.failed'),
        ]);
    }


    RateLimiter::clear($this->throttleKey());
}
public function ensureIsNotRateLimited(): void
{
    if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
        return;
    }

    event(new \Illuminate\Auth\Events\Lockout($this));

    $seconds = RateLimiter::availableIn($this->throttleKey());

    throw \Illuminate\Validation\ValidationException::withMessages([
        'username' => trans('auth.throttle', [
            'seconds' => $seconds,
            'minutes' => ceil($seconds / 60),
        ]),
    ]);
}

public function throttleKey(): string
{
    // Update throttle to use the username string
    return Str::transliterate(Str::lower($this->string('username')).'|'.$this->ip());
}
}
