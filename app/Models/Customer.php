<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasFactory, HasApiTokens,Notifiable;

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'phone_number',
        'user_name',
        'user_name',
        'bio',
        'profile_picture'
    ];
    protected $hidden = [
        'password',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $value,
            set: fn(string $value) => Hash::make($value),
        );
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
