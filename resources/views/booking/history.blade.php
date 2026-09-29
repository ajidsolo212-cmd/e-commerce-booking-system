@extends('layouts.app')
@section('title', 'Booking History')

@section('content')
<div class="page-header">
    <div class="eyebrow">My Account</div>
    <h1>Booking <em>history</em></h1>
</div>
<div class="container" style="padding-top:3rem;padding-bottom:5rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
        <div style="font-family:'Space Mono',monospace;font-size:0.6rem;letter-spacing:0.1em;color:var(--muted);">{{ $bookings->count() }} booking(s)</div>
        <a href="{{ route('booking.index') }}" class="btn btn-primary">New Booking</a>
    </div>
    @if($bookings->isEmpty())
        <div class="card" style="text-align:center;padding:4rem;">
            <p style="color:var(--muted);font-style:italic;margin-bottom:1.5rem;">You haven't made any bookings yet.</p>
            <a href="{{ route('booking.index') }}" class="btn btn-primary">Book your first session</a>
        </div>
    @else
        <div class="card" style="padding:0;">
            <table>
                <thead><tr><th>Code</th><th>Session</th><th>Date</th><th>Time</th><th>Price</th><th>Status</th></tr></thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td><span style="font-family:'Space Mono',monospace;font-size:0.75rem;color:var(--amber);">{{ $booking->booking_code }}</span></td>
                        <td>{{ $booking->studioSession->title }}</td>
                        <td>{{ $booking->booking_date->format('d M Y') }}</td>
                        <td style="font-family:'Space Mono',monospace;font-size:0.8rem;">{{ $booking->booking_time }}</td>
                        <td>RM {{ number_format($booking->total_price, 2) }}</td>
                        <td><span class="badge badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <div style="margin-top:2rem;">
        <a href="{{ route('orders.history') }}" class="btn btn-outline">View order history</a>
    </div>
</div>
@endsection