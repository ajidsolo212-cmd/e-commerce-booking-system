@extends('layouts.app')
@section('title', 'Cart')

@section('content')
<div class="page-header">
    <div class="eyebrow">Shop / Cart</div>
    <h1>Your <em>cart</em></h1>
</div>
<div class="container" style="padding-top:3rem;padding-bottom:5rem;">
    @if(empty($products))
        <div class="card" style="text-align:center;padding:4rem;">
            <p style="color:var(--muted);font-style:italic;margin-bottom:1.5rem;">Your cart is empty.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary">Browse the shop</a>
        </div>
    @else
        <div style="display:grid;grid-template-columns:1fr 320px;gap:3rem;align-items:start;">
            <div class="card" style="padding:0;">
                <table>
                    <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th><th></th></tr></thead>
                    <tbody>
                        @foreach($products as $item)
                        <tr>
                            <td>
                                <div style="font-size:1rem;color:var(--white);">{{ $item['product']->name }}</div>
                                <div style="font-family:'Space Mono',monospace;font-size:0.58rem;color:var(--amber);margin-top:0.2rem;">{{ $item['product']->category_label }}</div>
                            </td>
                            <td>RM {{ number_format($item['product']->price, 2) }}</td>
                            <td style="font-family:'Space Mono',monospace;">{{ $item['quantity'] }}</td>
                            <td>RM {{ number_format($item['subtotal'], 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('shop.removeFromCart', $item['product']) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card">
                <div style="font-family:'Space Mono',monospace;font-size:0.6rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--muted);margin-bottom:1.5rem;">Order Summary</div>
                <div style="display:flex;justify-content:space-between;margin-bottom:1rem;"><span style="color:var(--muted);">Subtotal</span><span>RM {{ number_format($total, 2) }}</span></div>
                <div style="display:flex;justify-content:space-between;margin-bottom:1.5rem;"><span style="color:var(--muted);">Shipping</span><span style="color:var(--muted);font-size:0.85rem;">At checkout</span></div>
                <div style="border-top:1px solid var(--border);padding-top:1rem;display:flex;justify-content:space-between;margin-bottom:2rem;">
                    <span style="font-family:'Space Mono',monospace;font-size:0.65rem;letter-spacing:0.08em;text-transform:uppercase;">Total</span>
                    <span style="font-size:1.8rem;font-weight:300;">RM {{ number_format($total, 2) }}</span>
                </div>
                <a href="{{ route('shop.checkout') }}" class="btn btn-primary" style="display:block;text-align:center;">Proceed to Checkout →</a>
                <a href="{{ route('shop.index') }}" class="btn btn-outline" style="display:block;text-align:center;margin-top:0.75rem;">Continue Shopping</a>
            </div>
        </div>
    @endif
</div>
@endsection