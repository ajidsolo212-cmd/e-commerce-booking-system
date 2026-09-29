@extends('layouts.admin')
@section('title', 'Bookings')
@section('breadcrumb', 'Bookings')

@section('content')
<div class="panel">
    <table>
        <thead><tr><th>Code</th><th>Client</th><th>Session</th><th>Date</th><th>Time</th><th>Price</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($bookings as $b)
            <tr>
                <td style="font-family:'Space Mono',monospace;font-size:0.7rem;color:var(--amber);">{{ $b->booking_code }}</td>
                <td>{{ $b->user->name }}</td>
                <td style="font-size:0.85rem;">{{ $b->studioSession->title }}</td>
                <td style="font-family:'Space Mono',monospace;font-size:0.75rem;">{{ $b->booking_date->format('d M Y') }}</td>
                <td style="font-family:'Space Mono',monospace;font-size:0.75rem;">{{ $b->booking_time }}</td>
                <td>RM {{ number_format($b->total_price, 2) }}</td>
                <td><span class="badge badge-{{ $b->status }}">{{ ucfirst($b->status) }}</span></td>
                <td><a href="{{ route('admin.bookings.show', $b) }}" class="btn btn-outline btn-sm">Manage</a></td>
            </tr>
            @empty
            <tr><td colspan="8" style="color:var(--muted);font-style:italic;">No bookings yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection