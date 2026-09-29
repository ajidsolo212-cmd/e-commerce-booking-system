<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Grainhaus') — Film Photography Studio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --black:   #0d0c0b;
            --dark:    #181614;
            --surface: #201e1b;
            --border:  #2e2b27;
            --amber:   #c8933a;
            --amber-l: #e0aa55;
            --cream:   #e8dfd0;
            --muted:   #7a7067;
            --white:   #f5f0e8;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            background-color: var(--black);
            color: var(--cream);
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 18px;
            line-height: 1.7;
            min-height: 100vh;
        }
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 3rem; height: 68px;
            background: rgba(13,12,11,0.92); backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
        }
        .nav-logo {
            font-family: 'Space Mono', monospace; font-size: 1rem; font-weight: 700;
            color: var(--amber); text-decoration: none; letter-spacing: 0.15em; text-transform: uppercase;
        }
        .nav-links { display: flex; align-items: center; gap: 2.5rem; list-style: none; }
        .nav-links a {
            font-family: 'Space Mono', monospace; font-size: 0.7rem; color: var(--muted);
            text-decoration: none; letter-spacing: 0.12em; text-transform: uppercase; transition: color 0.2s;
        }
        .nav-links a:hover { color: var(--amber); }
        .nav-right { display: flex; align-items: center; gap: 1.5rem; }
        .nav-cart {
            font-family: 'Space Mono', monospace; font-size: 0.7rem; color: var(--muted);
            text-decoration: none; letter-spacing: 0.1em; text-transform: uppercase;
            transition: color 0.2s; display: flex; align-items: center; gap: 0.4rem;
        }
        .nav-cart:hover { color: var(--amber); }
        .nav-btn {
            font-family: 'Space Mono', monospace; font-size: 0.65rem; letter-spacing: 0.12em;
            text-transform: uppercase; padding: 0.5rem 1.2rem; border: 1px solid var(--amber);
            color: var(--amber); background: transparent; text-decoration: none; cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .nav-btn:hover { background: var(--amber); color: var(--black); }
        .nav-btn-logout { border-color: var(--border); color: var(--muted); }
        .nav-btn-logout:hover { background: var(--border); color: var(--cream); }
        main { padding-top: 68px; min-height: calc(100vh - 68px); }
        .alert {
            padding: 1rem 2rem; font-family: 'Space Mono', monospace; font-size: 0.7rem;
            letter-spacing: 0.08em; border-left: 3px solid; margin: 1.5rem 3rem;
        }
        .alert-success { border-color: var(--amber); background: rgba(200,147,58,0.08); color: var(--amber-l); }
        .alert-error   { border-color: #c84a3a; background: rgba(200,74,58,0.08); color: #e06858; }
        footer {
            border-top: 1px solid var(--border); padding: 3rem;
            display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 2rem; margin-top: 5rem;
        }
        footer .footer-brand {
            font-family: 'Space Mono', monospace; font-size: 0.9rem; color: var(--amber);
            letter-spacing: 0.15em; font-weight: 700; margin-bottom: 0.75rem;
        }
        footer p, footer a { font-size: 0.85rem; color: var(--muted); line-height: 1.8; text-decoration: none; }
        footer a:hover { color: var(--cream); }
        footer h4 {
            font-family: 'Space Mono', monospace; font-size: 0.65rem; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--cream); margin-bottom: 1rem;
        }
        .footer-bottom {
            border-top: 1px solid var(--border); padding: 1.5rem 3rem;
            display: flex; justify-content: space-between; align-items: center;
        }
        .footer-bottom p { font-family: 'Space Mono', monospace; font-size: 0.6rem; color: var(--muted); letter-spacing: 0.08em; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 3rem; }
        .section { padding: 5rem 0; }
        .page-header { padding: 5rem 3rem 3rem; border-bottom: 1px solid var(--border); }
        .page-header .eyebrow {
            font-family: 'Space Mono', monospace; font-size: 0.65rem; letter-spacing: 0.2em;
            text-transform: uppercase; color: var(--amber); margin-bottom: 1rem;
        }
        .page-header h1 { font-size: 3.5rem; font-weight: 300; letter-spacing: -0.02em; line-height: 1.1; color: var(--white); }
        .page-header h1 em { font-style: italic; color: var(--amber-l); }
        .btn {
            display: inline-block; font-family: 'Space Mono', monospace; font-size: 0.65rem;
            letter-spacing: 0.12em; text-transform: uppercase; padding: 0.8rem 1.8rem;
            cursor: pointer; text-decoration: none; transition: all 0.2s; border: none;
        }
        .btn-primary { background: var(--amber); color: var(--black); }
        .btn-primary:hover { background: var(--amber-l); }
        .btn-outline { border: 1px solid var(--border); color: var(--cream); background: transparent; }
        .btn-outline:hover { border-color: var(--amber); color: var(--amber); }
        .btn-danger  { background: #c84a3a; color: var(--white); }
        .btn-danger:hover { background: #e05a48; }
        .btn-sm { padding: 0.4rem 0.8rem; font-size: 0.55rem; }
        .card { background: var(--surface); border: 1px solid var(--border); padding: 2rem; }
        .badge {
            font-family: 'Space Mono', monospace; font-size: 0.58rem; letter-spacing: 0.1em;
            text-transform: uppercase; padding: 0.25rem 0.6rem; border-radius: 2px;
        }
        .badge-pending    { background: rgba(200,147,58,0.15); color: var(--amber); }
        .badge-confirmed  { background: rgba(58,147,100,0.15); color: #5dcf93; }
        .badge-completed  { background: rgba(58,100,200,0.15); color: #6ea8fe; }
        .badge-cancelled  { background: rgba(200,74,58,0.15); color: #e06858; }
        .badge-processing { background: rgba(147,58,200,0.15); color: #c07fff; }
        .badge-shipped    { background: rgba(58,170,200,0.15); color: #5dcfdf; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { border-bottom: 1px solid var(--border); }
        th {
            font-family: 'Space Mono', monospace; font-size: 0.6rem; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--muted); padding: 1rem 1.2rem; text-align: left;
        }
        td { padding: 1rem 1.2rem; font-size: 0.9rem; border-bottom: 1px solid rgba(46,43,39,0.5); color: var(--cream); }
        tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: rgba(255,255,255,0.02); }
        .form-group { margin-bottom: 1.5rem; }
        label {
            display: block; font-family: 'Space Mono', monospace; font-size: 0.6rem;
            letter-spacing: 0.12em; text-transform: uppercase; color: var(--muted); margin-bottom: 0.5rem;
        }
        input, textarea, select {
            width: 100%; background: var(--dark); border: 1px solid var(--border);
            color: var(--cream); padding: 0.85rem 1rem;
            font-family: 'Cormorant Garamond', serif; font-size: 1rem; outline: none; transition: border-color 0.2s;
        }
        input:focus, textarea:focus, select:focus { border-color: var(--amber); }
        .form-error { font-family: 'Space Mono', monospace; font-size: 0.58rem; color: #e06858; margin-top: 0.3rem; }
        @media (max-width: 768px) {
            nav { padding: 0 1.5rem; }
            .nav-links { display: none; }
            .container { padding: 0 1.5rem; }
            .page-header { padding: 4rem 1.5rem 2rem; }
            .page-header h1 { font-size: 2.4rem; }
            footer { grid-template-columns: 1fr; padding: 2rem 1.5rem; }
            .footer-bottom { padding: 1rem 1.5rem; flex-direction: column; gap: 0.5rem; }
        }
    </style>
    @stack('head')
</head>
<body>
<nav>
    <a href="{{ route('home') }}" class="nav-logo">⬡ Grainhaus</a>
    <ul class="nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('about') }}">About</a></li>
        <li><a href="{{ route('booking.index') }}">Book</a></li>
        <li><a href="{{ route('shop.index') }}">Shop</a></li>
        <li><a href="{{ route('gallery') }}">Gallery</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
    </ul>
    <div class="nav-right">
        @auth
            <a href="{{ route('shop.cart') }}" class="nav-cart">
                ⬡ Cart
                @php $cartCount = collect(session('cart', []))->sum('quantity'); @endphp
                @if($cartCount > 0)
                    <span style="background:var(--amber);color:var(--black);border-radius:50%;width:18px;height:18px;display:inline-flex;align-items:center;justify-content:center;font-size:0.55rem;font-weight:700;">{{ $cartCount }}</span>
                @endif
            </a>
            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="nav-btn" style="font-size:0.6rem;">Admin</a>
            @else
                <a href="{{ route('booking.history') }}" style="font-family:'Space Mono',monospace;font-size:0.65rem;color:var(--muted);text-decoration:none;letter-spacing:0.08em;">My Account</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="nav-btn nav-btn-logout">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-btn">Sign In</a>
        @endauth
    </div>
</nav>
<main>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif
    @yield('content')
</main>
<footer>
    <div>
        <div class="footer-brand">⬡ Grainhaus</div>
        <p>A boutique film photography studio in Kuala Lumpur. Analog, honest, and slow.</p>
    </div>
    <div>
        <h4>Navigate</h4>
        <p><a href="{{ route('about') }}">About the Studio</a></p>
        <p><a href="{{ route('booking.index') }}">Book a Session</a></p>
        <p><a href="{{ route('shop.index') }}">Film Shop</a></p>
        <p><a href="{{ route('gallery') }}">Gallery</a></p>
        <p><a href="{{ route('contact') }}">Contact</a></p>
    </div>
    <div>
        <h4>Studio Hours</h4>
        <p>Tuesday – Saturday</p>
        <p>10:00 — 18:00</p>
        <br>
        <p>hello@grainhaus.my</p>
        <p>+60 12-345 6789</p>
    </div>
</footer>
<div class="footer-bottom">
    <p>© {{ date('Y') }} Grainhaus Film Studio. All rights reserved.</p>
    <p>Made on 35mm.</p>
</div>
@stack('scripts')
</body>
</html>