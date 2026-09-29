<?php

namespace App\Http\Controllers;

use App\Models\StudioSession;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sessions = StudioSession::where('is_active', true)->get();
        return view('booking.index', compact('sessions'));
    }

    public function create(StudioSession $session)
    {
        if ($session->available_slots <= 0) {
            return redirect()->route('booking.index')->with('error', 'This session is fully booked.');
        }
        return view('booking.create', compact('session'));
    }

    public function store(Request $request, StudioSession $session)
    {
        $data = $request->validate([
            'booking_date' => 'required|date|after:today',
            'booking_time' => 'required',
            'notes'        => 'nullable|string|max:500',
        ]);

        if ($session->available_slots <= 0) {
            return back()->with('error', 'No slots available.');
        }

        $booking = Booking::create([
            'user_id'           => Auth::id(),
            'studio_session_id' => $session->id,
            'booking_date'      => $data['booking_date'],
            'booking_time'      => $data['booking_time'],
            'notes'             => $data['notes'] ?? null,
            'status'            => 'pending',
            'total_price'       => $session->price,
            'booking_code'      => Booking::generateCode(),
        ]);

        $session->increment('booked_slots');

        return redirect()->route('booking.history')
            ->with('success', "Booking confirmed! Your code: {$booking->booking_code}");
    }

    public function history()
    {
        $bookings = Auth::user()->bookings()->with('studioSession')->latest()->get();
        return view('booking.history', compact('bookings'));
    }
}