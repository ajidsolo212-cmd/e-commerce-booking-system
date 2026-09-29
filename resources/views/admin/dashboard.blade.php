@extends('layouts.admin')
@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card"><div class="stat-label">Total Users</div><div class="stat-value">{{ $stats['total_users'] }}</div></div>
    <div class="stat-card"><div class="stat-label">Total Bookings</div><div class="stat-value">{{ $stats['total_bookings'] }}</div><div class="stat-note">{{ $stats['pending_bookings'] }} pending</div></div>
    <div class="stat-card"><div class="stat-label">Total Orders</div><div class="stat-value">{{ $stats['total_orders'] }}</div><div class="stat-note">{{ $stats['pending_orders'] }} pending</div></div>
    <div class="stat-card"><div class="stat-label">Revenue (Completed)</div><div class="stat-value" style="font-size:1.8rem;">RM {{ number_format($stats['revenue_bookings'] + $stats['revenue_orders'], 0) }}</div></div>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">
    <div class="panel">
        <div class="panel-header"><h2>Recent Bookings</h2><a href="{{ route('admin.bookings.index') }}" class="btn btn-outline btn-sm">View all</a></div>
        <table>
            <thead><tr><th>Code</th><th>Client</th><th>Session</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($recent_bookings as $b)
                <tr>
                    <td style="font-family:'Space Mono',monospace;font-size:0.7rem;color:var(--amber);">{{ $b->booking_code }}</td>
                    <td>{{ $b->user->name }}</td>
                    <td style="font-size:0.85rem;">{{ $b->studioSession->title }}</td>
                    <td><span class="badge badge-{{ $b->status }}">{{ ucfirst($b->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="4" style="color:var(--muted);font-style:italic;">No bookings yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="panel">
        <div class="panel-header"><h2>Recent Orders</h2><a href="{{ route('admin.orders.index') }}" class="btn btn-outline btn-sm">View all</a></div>
        <table>
            <thead><tr><th>Code</th><th>Client</th><th>Total</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($recent_orders as $o)
                <tr>
                    <td style="font-family:'Space Mono',monospace;font-size:0.7rem;color:var(--amber);">{{ $o->order_code }}</td>
                    <td>{{ $o->user->name }}</td>
                    <td>RM {{ number_format($o->total_price, 2) }}</td>
                    <td><span class="badge badge-{{ $o->status }}">{{ ucfirst($o->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="4" style="color:var(--muted);font-style:italic;">No orders yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection