<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'phone', 'password', 'is_admin'];
    protected $hidden   = ['password', 'remember_token'];

    protected $casts = [
        'is_admin'          => 'boolean',
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}