@extends('layouts.app')
@section('title', 'Book — ' . $session->title)

@section('content')
<div class="page-header">
    <div class="eyebrow"><a href="{{ route('booking.index') }}" style="color:var(--amber);text-decoration:none;">Sessions</a> / Booking</div>
    <h1>{{ $session->title }}</h1>
</div>
<div class="container" style="padding-top:3rem;padding-bottom:5rem;">
    <div style="display:grid;grid-template-columns:1fr 1.2fr;gap:4rem;align-items:start;">
        <div class="card">
            <div style="font-family:'Space Mono',monospace;font-size:0.6rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--amber);margin-bottom:1rem;">Session Details</div>
            <h2 style="font-size:1.8rem;font-weight:300;color:var(--white);margin-bottom:1rem;">{{ $session->title }}</h2>
            <p style="color:var(--muted);line-height:1.8;margin-bottom:2rem;font-size:0.95rem;">{{ $session->description }}</p>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1px;background:var(--border);">
                <div style="background:var(--dark);padding:1.2rem;">
                    <div style="font-family:'Space Mono',monospace;font-size:0.55rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem;">Duration</div>
                    <div style="font-size:1.1rem;color:var(--white);">{{ $session->duration }}</div>
                </div>
                <div style="background:var(--dark);padding:1.2rem;">
                    <div style="font-family:'Space Mono',monospace;font-size:0.55rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem;">Price</div>
                    <div style="font-size:1.1rem;color:var(--white);">RM {{ number_format($session->price, 2) }}</div>
                </div>
            </div>
        </div>
        <div>
            <form method="POST" action="{{ route('booking.store', $session) }}">
                @csrf
                <div class="form-group">
                    <label>Preferred Date</label>
                    <input type="date" name="booking_date" value="{{ old('booking_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    @error('booking_date')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Preferred Time</label>
                    <select name="booking_time" required>
                        <option value="">Select a time slot</option>
                        <option value="10:00" {{ old('booking_time') === '10:00' ? 'selected' : '' }}>10:00 AM</option>
                        <option value="12:00" {{ old('booking_time') === '12:00' ? 'selected' : '' }}>12:00 PM</option>
                        <option value="14:00" {{ old('booking_time') === '14:00' ? 'selected' : '' }}>2:00 PM</option>
                        <option value="16:00" {{ old('booking_time') === '16:00' ? 'selected' : '' }}>4:00 PM</option>
                    </select>
                    @error('booking_time')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Notes <span style="color:var(--muted);font-size:0.55rem;">(optional)</span></label>
                    <textarea name="notes" rows="4" placeholder="Any specific requests or things we should know...">{{ old('notes') }}</textarea>
                </div>
                <div style="background:var(--surface);border:1px solid var(--border);padding:1.5rem;margin-bottom:1.5rem;">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-family:'Space Mono',monospace;font-size:0.65rem;letter-spacing:0.08em;text-transform:uppercase;color:var(--muted);">Total</span>
                        <span style="font-size:2rem;font-weight:300;color:var(--white);">RM {{ number_format($session->price, 2) }}</span>
                    </div>
                    <p style="font-family:'Space Mono',monospace;font-size:0.55rem;color:var(--muted);margin-top:0.5rem;">Payment collected at the studio on the day of your session.</p>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;">Confirm Booking →</button>
            </form>
        </div>
    </div>
</div>
@endsection