@extends('layouts.admin')
@section('title', 'Booking Detail')
@section('breadcrumb', 'Bookings / Detail')

@section('content')
<div style="display:grid;grid-template-columns:1fr 320px;gap:2rem;align-items:start;">
    <div class="panel">
        <div class="panel-header"><h2>{{ $booking->booking_code }}</h2><span class="badge badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></div>
        <div class="panel-body">
            <div class="grid-2" style="margin-bottom:1.5rem;">
                <div>
                    <div style="font-family:'Space Mono',monospace;font-size:0.55rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem;">Client</div>
                    <div>{{ $booking->user->name }}</div>
                    <div style="font-size:0.85rem;color:var(--muted);">{{ $booking->user->email }}</div>
                    <div style="font-size:0.85rem;color:var(--muted);">{{ $booking->user->phone }}</div>
                </div>
                <div>
                    <div style="font-family:'Space Mono',monospace;font-size:0.55rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem;">Session</div>
                    <div>{{ $booking->studioSession->title }}</div>
                    <div style="font-size:0.85rem;color:var(--muted);">{{ $booking->studioSession->duration }}</div>
                </div>
            </div>
            <div class="grid-2">
                <div>
                    <div style="font-family:'Space Mono',monospace;font-size:0.55rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem;">Date & Time</div>
                    <div>{{ $booking->booking_date->format('d M Y') }} at {{ $booking->booking_time }}</div>
                </div>
                <div>
                    <div style="font-family:'Space Mono',monospace;font-size:0.55rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem;">Total</div>
                    <div style="font-size:1.5rem;font-weight:300;">RM {{ number_format($booking->total_price, 2) }}</div>
                </div>
            </div>
            @if($booking->notes)
            <div style="margin-top:1.5rem;padding:1rem;background:var(--raised);border-left:2px solid var(--amber);">
                <div style="font-family:'Space Mono',monospace;font-size:0.55rem;color:var(--muted);margin-bottom:0.4rem;">CLIENT NOTES</div>
                <p style="font-size:0.9rem;line-height:1.7;">{{ $booking->notes }}</p>
            </div>
            @endif
        </div>
    </div>
    <div class="panel">
        <div class="panel-header"><h2>Update Status</h2></div>
        <div class="panel-body">
            <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking) }}">
                @csrf @method('PATCH')
                <div class="form-group"><label>New Status</label>
                    <select name="status" required>
                        @foreach(['pending','confirmed','completed','cancelled'] as $s)
                        <option value="{{ $s }}" {{ $booking->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;">Update Status</button>
            </form>
        </div>
    </div>
</div>
@endsection