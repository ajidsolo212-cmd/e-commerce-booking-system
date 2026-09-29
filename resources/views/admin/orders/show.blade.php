@extends('layouts.admin')
@section('title', 'Order Detail')
@section('breadcrumb', 'Orders / Detail')

@section('content')
<div style="display:grid;grid-template-columns:1fr 320px;gap:2rem;align-items:start;">
    <div class="panel">
        <div class="panel-header"><h2>{{ $order->order_code }}</h2><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></div>
        <div class="panel-body">
            <div class="grid-2" style="margin-bottom:1.5rem;">
                <div>
                    <div style="font-family:'Space Mono',monospace;font-size:0.55rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem;">Client</div>
                    <div>{{ $order->user->name }}</div>
                    <div style="font-size:0.85rem;color:var(--muted);">{{ $order->user->email }}</div>
                    <div style="font-size:0.85rem;color:var(--muted);">{{ $order->phone }}</div>
                </div>
                <div>
                    <div style="font-family:'Space Mono',monospace;font-size:0.55rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem;">Ship To</div>
                    <div style="font-size:0.9rem;">{{ $order->shipping_address }}</div>
                    <div style="font-size:0.9rem;color:var(--muted);">{{ $order->shipping_city }}, {{ $order->shipping_postcode }}</div>
                </div>
            </div>
            <table>
                <thead><tr><th>Product</th><th>Qty</th><th>Unit</th><th>Subtotal</th></tr></thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? '[deleted]' }}</td>
                        <td style="font-family:'Space Mono',monospace;">{{ $item->quantity }}</td>
                        <td>RM {{ number_format($item->unit_price, 2) }}</td>
                        <td>RM {{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin-top:1rem;padding-top:1rem;border-top:1px solid var(--border);display:flex;justify-content:flex-end;align-items:center;gap:1rem;">
                <span style="font-family:'Space Mono',monospace;font-size:0.6rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;">Total</span>
                <span style="font-size:1.6rem;font-weight:300;">RM {{ number_format($order->total_price, 2) }}</span>
            </div>
            @if($order->notes)
            <div style="margin-top:1.5rem;padding:1rem;background:var(--raised);border-left:2px solid var(--amber);">
                <div style="font-family:'Space Mono',monospace;font-size:0.55rem;color:var(--muted);margin-bottom:0.4rem;">ORDER NOTES</div>
                <p style="font-size:0.9rem;">{{ $order->notes }}</p>
            </div>
            @endif
        </div>
    </div>
    <div class="panel">
        <div class="panel-header"><h2>Update Status</h2></div>
        <div class="panel-body">
            <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}">
                @csrf @method('PATCH')
                <div class="form-group"><label>New Status</label>
                    <select name="status" required>
                        @foreach(['pending','processing','shipped','completed','cancelled'] as $s)
                        <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;">Update Status</button>
            </form>
        </div>
    </div>
</div>
@endsection