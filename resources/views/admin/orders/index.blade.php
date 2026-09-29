@extends('layouts.admin')
@section('title', 'Orders')
@section('breadcrumb', 'Orders')

@section('content')
<div class="panel">
    <table>
        <thead><tr><th>Code</th><th>Client</th><th>Items</th><th>Total</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($orders as $o)
            <tr>
                <td style="font-family:'Space Mono',monospace;font-size:0.7rem;color:var(--amber);">{{ $o->order_code }}</td>
                <td>{{ $o->user->name }}</td>
                <td style="font-family:'Space Mono',monospace;font-size:0.75rem;">{{ $o->items->count() }} item(s)</td>
                <td>RM {{ number_format($o->total_price, 2) }}</td>
                <td style="font-family:'Space Mono',monospace;font-size:0.7rem;">{{ $o->created_at->format('d M Y') }}</td>
                <td><span class="badge badge-{{ $o->status }}">{{ ucfirst($o->status) }}</span></td>
                <td><a href="{{ route('admin.orders.show', $o) }}" class="btn btn-outline btn-sm">Manage</a></td>
            </tr>
            @empty
            <tr><td colspan="7" style="color:var(--muted);font-style:italic;">No orders yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection