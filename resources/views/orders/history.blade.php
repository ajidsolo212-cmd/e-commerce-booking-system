@extends('layouts.app')
@section('title', 'Order History')

@section('content')
<div class="page-header">
    <div class="eyebrow">My Account</div>
    <h1>Order <em>history</em></h1>
</div>
<div class="container" style="padding-top:3rem;padding-bottom:5rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
        <div style="font-family:'Space Mono',monospace;font-size:0.6rem;letter-spacing:0.1em;color:var(--muted);">{{ $orders->count() }} order(s)</div>
        <a href="{{ route('shop.index') }}" class="btn btn-primary">Shop</a>
    </div>
    @if($orders->isEmpty())
        <div class="card" style="text-align:center;padding:4rem;">
            <p style="color:var(--muted);font-style:italic;margin-bottom:1.5rem;">You haven't placed any orders yet.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary">Browse the shop</a>
        </div>
    @else
        @foreach($orders as $order)
        <div class="card" style="margin-bottom:1.5rem;">
            <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem;">
                <div>
                    <div style="font-family:'Space Mono',monospace;font-size:0.75rem;color:var(--amber);margin-bottom:0.3rem;">{{ $order->order_code }}</div>
                    <div style="font-family:'Space Mono',monospace;font-size:0.6rem;color:var(--muted);">{{ $order->created_at->format('d M Y') }}</div>
                </div>
                <span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
            </div>
            <table>
                <thead><tr><th>Item</th><th>Qty</th><th>Price</th></tr></thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? '[deleted product]' }}</td>
                        <td style="font-family:'Space Mono',monospace;">{{ $item->quantity }}</td>
                        <td>RM {{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin-top:1rem;padding-top:1rem;border-top:1px solid var(--border);display:flex;justify-content:flex-end;align-items:center;gap:1rem;">
                <span style="font-family:'Space Mono',monospace;font-size:0.6rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;">Total</span>
                <span style="font-size:1.4rem;font-weight:300;">RM {{ number_format($order->total_price, 2) }}</span>
            </div>
        </div>
        @endforeach
    @endif
    <div style="margin-top:2rem;">
        <a href="{{ route('booking.history') }}" class="btn btn-outline">View booking history</a>
    </div>
</div>
@endsection