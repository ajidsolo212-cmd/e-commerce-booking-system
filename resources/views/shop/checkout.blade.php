@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="page-header">
    <div class="eyebrow">Shop / Checkout</div>
    <h1>Complete your <em>order</em></h1>
</div>
<div class="container" style="padding-top:3rem;padding-bottom:5rem;">
    <div style="display:grid;grid-template-columns:1fr 340px;gap:4rem;align-items:start;">
        <form method="POST" action="{{ route('orders.store') }}">
            @csrf
            <div style="font-family:'Space Mono',monospace;font-size:0.6rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);margin-bottom:1.5rem;">Shipping Details</div>
            <div class="form-group">
                <label>Street Address</label>
                <input type="text" name="shipping_address" value="{{ old('shipping_address') }}" required>
                @error('shipping_address')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="shipping_city" value="{{ old('shipping_city') }}" required>
                    @error('shipping_city')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Postcode</label>
                    <input type="text" name="shipping_postcode" value="{{ old('shipping_postcode') }}" required>
                    @error('shipping_postcode')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="form-group">
                <label>Contact Phone</label>
                <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required>
                @error('phone')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Order Notes <span style="color:var(--muted);font-size:0.55rem;">(optional)</span></label>
                <textarea name="notes" rows="3">{{ old('notes') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;margin-top:0.5rem;">Place Order →</button>
        </form>
        <div class="card">
            <div style="font-family:'Space Mono',monospace;font-size:0.6rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--muted);margin-bottom:1.5rem;">Your Order</div>
            @foreach($products as $item)
            <div style="display:flex;justify-content:space-between;padding:0.75rem 0;border-bottom:1px solid var(--border);">
                <div>
                    <div style="font-size:0.9rem;color:var(--white);">{{ $item['product']->name }}</div>
                    <div style="font-family:'Space Mono',monospace;font-size:0.55rem;color:var(--muted);margin-top:0.2rem;">× {{ $item['quantity'] }}</div>
                </div>
                <div style="font-size:0.9rem;">RM {{ number_format($item['subtotal'], 2) }}</div>
            </div>
            @endforeach
            <div style="padding-top:1.5rem;display:flex;justify-content:space-between;align-items:center;">
                <span style="font-family:'Space Mono',monospace;font-size:0.65rem;letter-spacing:0.08em;text-transform:uppercase;color:var(--muted);">Total</span>
                <span style="font-size:2rem;font-weight:300;color:var(--white);">RM {{ number_format($total, 2) }}</span>
            </div>
        </div>
    </div>
</div>
@endsection