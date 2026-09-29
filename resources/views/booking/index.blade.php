@extends('layouts.app')
@section('title', 'Book a Session')

@push('head')
<style>
    .sessions-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1px; background: var(--border); }
    .session-card { background: var(--surface); padding: 3rem; display: flex; flex-direction: column; transition: background 0.2s; }
    .session-card:hover { background: var(--dark); }
    .session-duration { font-family: 'Space Mono', monospace; font-size: 0.6rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--amber); margin-bottom: 1rem; }
    .session-card h3 { font-size: 1.8rem; font-weight: 300; color: var(--white); margin-bottom: 1rem; }
    .session-card p  { color: var(--muted); font-size: 0.9rem; line-height: 1.8; flex: 1; margin-bottom: 1.5rem; }
    .session-footer  { display: flex; align-items: center; justify-content: space-between; margin-top: auto; }
    .session-price   { font-size: 1.8rem; font-weight: 300; color: var(--white); }
    .session-price span { font-family: 'Space Mono', monospace; font-size: 0.6rem; color: var(--muted); margin-left: 0.3rem; }
    .session-slots   { font-family: 'Space Mono', monospace; font-size: 0.58rem; letter-spacing: 0.08em; color: var(--muted); margin-bottom: 1rem; }
    .session-slots.low { color: #e06858; }
    @media (max-width: 768px) { .sessions-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="eyebrow">Studio Sessions</div>
    <h1>Book a <em>session</em></h1>
</div>
<div class="container" style="padding-top:3rem;padding-bottom:5rem;">
    <div class="sessions-grid">
        @forelse($sessions as $session)
        <div class="session-card">
            <div class="session-duration">{{ $session->duration }}</div>
            <h3>{{ $session->title }}</h3>
            <p>{{ $session->description }}</p>
            <div class="session-slots {{ $session->available_slots <= 2 ? 'low' : '' }}">
                {{ $session->available_slots }} slot{{ $session->available_slots !== 1 ? 's' : '' }} available
            </div>
            <div class="session-footer">
                <div class="session-price">RM {{ number_format($session->price, 2) }}<span>per session</span></div>
                @if($session->available_slots > 0)
                    <a href="{{ route('booking.create', $session) }}" class="btn btn-primary">Book →</a>
                @else
                    <span class="btn btn-outline" style="opacity:0.4;cursor:not-allowed;">Fully Booked</span>
                @endif
            </div>
        </div>
        @empty
        <div style="padding:3rem;color:var(--muted);grid-column:1/-1;font-style:italic;">No sessions currently available.</div>
        @endforelse
    </div>
    <div style="margin-top:3rem;text-align:center;">
        <a href="{{ route('booking.history') }}" class="btn btn-outline">View my booking history</a>
    </div>
</div>
@endsection