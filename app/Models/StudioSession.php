<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudioSession extends Model
{
    protected $fillable = [
        'title', 'description', 'duration', 'price',
        'max_slots', 'booked_slots', 'image', 'is_active'
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getAvailableSlotsAttribute(): int
    {
        return $this->max_slots - $this->booked_slots;
    }
}