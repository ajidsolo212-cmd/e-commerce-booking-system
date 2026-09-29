<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'studio_session_id', 'booking_date',
        'booking_time', 'notes', 'status', 'total_price', 'booking_code'
    ];

    protected $casts = ['booking_date' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studioSession()
    {
        return $this->belongsTo(StudioSession::class);
    }

    public static function generateCode(): string
    {
        return 'GH-B-' . strtoupper(substr(uniqid(), -6));
    }
}