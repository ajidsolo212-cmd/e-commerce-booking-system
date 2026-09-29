@extends('layouts.app')
@section('title', 'Film Shop')

@push('head')
<style>
    .shop-layout { display: grid; grid-template-columns: 220px 1fr; gap: 3rem; padding: 3rem 3rem 5rem; }
    .shop-filters { position: sticky; top: 88px; }
    .filter-label { font-family: 'Space Mono', monospace; font-size: 0.58rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--muted); margin-bottom: 1rem; }
    .filter-btn { display: block; width: 100%; font-family: 'Space Mono', monospace; font-size: 0.62rem; letter-spacing: 0.08em; text-transform: uppercase; padding: 0.7rem 1rem; margin-bottom: 4px; background: transparent; border: 1px solid var(--border); color: var(--muted); text-decoration: none; text-align: left; transition: all 0.15s; cursor: pointer; }
    .filter-btn:hover, .filter-btn.active { border-color: var(--amber); color: var(--amber); }
    .products-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; background: var(--border); }
    .product-card { background: var(--surface); padding: 2rem; display: flex; flex-direction: column; transition: background 0.2s; }
    .product-card:hover { background: var(--dark); }
    .product-category { font-family: 'Space Mono', monospace; font-size: 0.55rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--amber); margin-bottom: 0.75rem; }
    .product-card h3 { font-size: 1.2rem; font-weight: 400; color: var(--white); margin-bottom: 0.75rem; line-height: 1.3; }
    .product-card p  { color: var(--muted); font-size: 0.85rem; line-height: 1.7; flex: 1; margin-bottom: 1.5rem; }
    .product-price   { font-size: 1.5rem; font-weight: 300; color: var(--white); margin-bottom: 1rem; }
    .product-stock   { font-family: 'Space Mono', monospace; font-size: 0.55rem; color: var(--muted); margin-bottom: 1rem; }
    .add-to-cart     { display: flex; gap: 0.5rem; }
    .qty-input       { width: 60px !important; text-align: center; padding: 0.6rem !important; }
    @media (max-width: 900px) { .shop-layout { grid-template-columns: 1fr; } .shop-filters { position: static; } .products-grid { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 600px) { .products-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="eyebrow">Shop</div>
    <h1>Film & <em>Prints</em></h1>
</div>
<div class="shop-layout">
    <aside class="shop-filters">
        <div class="filter-label">Categories</div>
        <a href="{{ route('shop.index') }}" class="filter-btn {{ !$category ? 'active' : '' }}">All Items</a>
        <a href="{{ route('shop.index') }}?category=film_roll" class="filter-btn {{ $category === 'film_roll' ? 'active' : '' }}">Film Rolls</a>
        <a href="{{ route('shop.index') }}?category=print" class="filter-btn {{ $category === 'print' ? 'active' : '' }}">Darkroom Prints</a>
        <a href="{{ route('shop.index') }}?category=accessory" class="filter-btn {{ $category === 'accessory' ? 'active' : '' }}">Services & Gear</a>
        @auth
        <div style="margin-top:2rem;">
            <a href="{{ route('shop.cart') }}" class="filter-btn" style="border-color:var(--amber);color:var(--amber);">
                ⬡ Cart @php $c = collect(session('cart',[]))->sum('quantity'); @endphp @if($c)({{ $c }})@endif
            </a>
        </div>
        @endauth
    </aside>
    <div>
        <div class="products-grid">
            @forelse($products as $product)
            <div class="product-card">
                <div class="product-category">{{ $product->category_label }}</div>
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <div style="margin-top:auto;">
                    <div class="product-price">RM {{ number_format($product->price, 2) }}</div>
                    <div class="product-stock">{{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }}</div>
                    @auth
                        @if($product->stock > 0)
                        <form method="POST" action="{{ route('shop.addToCart', $product) }}" class="add-to-cart">
                            @csrf
                            <input type="number" name="quantity" class="qty-input" value="1" min="1" max="{{ $product->stock }}">
                            <button type="submit" class="btn btn-primary" style="flex:1;">Add →</button>
                        </form>
                        @else
                        <span class="btn btn-outline" style="opacity:0.4;cursor:not-allowed;display:block;text-align:center;">Out of Stock</span>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline" style="display:block;text-align:center;">Sign in to order</a>
                    @endauth
                </div>
            </div>
            @empty
            <div style="padding:3rem;color:var(--muted);grid-column:1/-1;font-style:italic;">No products in this category.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection