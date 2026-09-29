<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'Dashboard') | Grainhaus</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --black:   #0a0908; --dark: #131110; --surface: #1a1816; --raised: #211f1c;
            --border:  #2b2824; --amber: #c8933a; --amber-l: #e0aa55; --cream: #e8dfd0;
            --muted:   #6a6258; --white: #f5f0e8; --danger: #c84a3a; --success: #3a9364;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: var(--black); color: var(--cream); font-family: 'Cormorant Garamond', serif; font-size: 17px; display: flex; min-height: 100vh; }
        .sidebar {
            width: 240px; min-height: 100vh; background: var(--dark); border-right: 1px solid var(--border);
            display: flex; flex-direction: column; position: fixed; top: 0; left: 0; z-index: 50;
        }
        .sidebar-logo { padding: 2rem 1.5rem; border-bottom: 1px solid var(--border); }
        .sidebar-logo a { font-family: 'Space Mono', monospace; font-size: 0.8rem; color: var(--amber); text-decoration: none; letter-spacing: 0.15em; font-weight: 700; }
        .sidebar-label { font-family: 'Space Mono', monospace; font-size: 0.55rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--muted); padding: 1.5rem 1.5rem 0.5rem; }
        .sidebar-nav { padding: 0.5rem 0; flex: 1; }
        .sidebar-nav a {
            display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1.5rem;
            font-family: 'Space Mono', monospace; font-size: 0.65rem; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--muted); text-decoration: none; transition: all 0.15s;
            border-left: 2px solid transparent;
        }
        .sidebar-nav a:hover, .sidebar-nav a.active { color: var(--amber); background: rgba(200,147,58,0.06); border-left-color: var(--amber); }
        .sidebar-footer { padding: 1.5rem; border-top: 1px solid var(--border); }
        .sidebar-footer p { font-family: 'Space Mono', monospace; font-size: 0.58rem; color: var(--muted); margin-bottom: 0.75rem; letter-spacing: 0.06em; }
        .sidebar-footer form button {
            width: 100%; font-family: 'Space Mono', monospace; font-size: 0.6rem; letter-spacing: 0.1em;
            text-transform: uppercase; padding: 0.6rem; background: transparent; border: 1px solid var(--border);
            color: var(--muted); cursor: pointer; transition: all 0.15s;
        }
        .sidebar-footer form button:hover { border-color: var(--danger); color: #e06858; }
        .admin-main { margin-left: 240px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .admin-header {
            padding: 1.5rem 2.5rem; border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            background: var(--dark); position: sticky; top: 0; z-index: 40;
        }
        .admin-header h1 { font-size: 1.4rem; font-weight: 300; color: var(--white); letter-spacing: 0.02em; }
        .admin-header .breadcrumb { font-family: 'Space Mono', monospace; font-size: 0.6rem; color: var(--muted); letter-spacing: 0.08em; }
        .admin-content { padding: 2.5rem; flex: 1; }
        .alert { padding: 0.9rem 1.5rem; font-family: 'Space Mono', monospace; font-size: 0.65rem; letter-spacing: 0.08em; border-left: 3px solid; margin-bottom: 2rem; }
        .alert-success { border-color: var(--success); background: rgba(58,147,100,0.08); color: #5dcf93; }
        .alert-error   { border-color: var(--danger); background: rgba(200,74,58,0.08); color: #e06858; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1px; background: var(--border); border: 1px solid var(--border); margin-bottom: 2.5rem; }
        .stat-card { background: var(--surface); padding: 1.8rem 2rem; }
        .stat-card .stat-label { font-family: 'Space Mono', monospace; font-size: 0.58rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--muted); margin-bottom: 0.5rem; }
        .stat-card .stat-value { font-size: 2.8rem; font-weight: 300; color: var(--white); line-height: 1; }
        .stat-card .stat-note  { font-family: 'Space Mono', monospace; font-size: 0.58rem; color: var(--amber); margin-top: 0.5rem; }
        .panel { background: var(--surface); border: 1px solid var(--border); margin-bottom: 2rem; }
        .panel-header { padding: 1.2rem 1.8rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .panel-header h2 { font-family: 'Space Mono', monospace; font-size: 0.65rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--cream); }
        .panel-body { padding: 1.8rem; }
        table { width: 100%; border-collapse: collapse; }
        th { font-family: 'Space Mono', monospace; font-size: 0.58rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--muted); padding: 0.9rem 1.2rem; text-align: left; border-bottom: 1px solid var(--border); }
        td { padding: 0.9rem 1.2rem; font-size: 0.88rem; border-bottom: 1px solid rgba(43,40,36,0.6); color: var(--cream); }
        tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: rgba(255,255,255,0.015); }
        .badge { font-family: 'Space Mono', monospace; font-size: 0.55rem; letter-spacing: 0.08em; text-transform: uppercase; padding: 0.22rem 0.55rem; border-radius: 2px; }
        .badge-pending    { background: rgba(200,147,58,0.15); color: var(--amber); }
        .badge-confirmed  { background: rgba(58,147,100,0.15); color: #5dcf93; }
        .badge-completed  { background: rgba(58,100,200,0.15); color: #6ea8fe; }
        .badge-cancelled  { background: rgba(200,74,58,0.15); color: #e06858; }
        .badge-processing { background: rgba(147,58,200,0.15); color: #c07fff; }
        .badge-shipped    { background: rgba(58,170,200,0.15); color: #5dcfdf; }
        .btn { display: inline-block; font-family: 'Space Mono', monospace; font-size: 0.62rem; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.6rem 1.2rem; cursor: pointer; text-decoration: none; transition: all 0.15s; border: none; }
        .btn-primary { background: var(--amber); color: var(--black); }
        .btn-primary:hover { background: var(--amber-l); }
        .btn-outline { border: 1px solid var(--border); color: var(--cream); background: transparent; }
        .btn-outline:hover { border-color: var(--amber); color: var(--amber); }
        .btn-danger { background: var(--danger); color: var(--white); }
        .btn-danger:hover { background: #e05a48; }
        .btn-sm { padding: 0.4rem 0.8rem; font-size: 0.55rem; }
        .form-group { margin-bottom: 1.5rem; }
        label { display: block; font-family: 'Space Mono', monospace; font-size: 0.58rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--muted); margin-bottom: 0.4rem; }
        input, textarea, select { width: 100%; background: var(--raised); border: 1px solid var(--border); color: var(--cream); padding: 0.8rem 1rem; font-family: 'Cormorant Garamond', serif; font-size: 1rem; outline: none; transition: border-color 0.15s; }
        input:focus, textarea:focus, select:focus { border-color: var(--amber); }
        .form-error { font-family: 'Space Mono', monospace; font-size: 0.55rem; color: #e06858; margin-top: 0.3rem; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; }
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="sidebar-logo">
        <a href="{{ route('admin.dashboard') }}">⬡ Grainhaus Admin</a>
    </div>
    <div class="sidebar-nav">
        <div class="sidebar-label">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">◈ Dashboard</a>
        <div class="sidebar-label">Bookings</div>
        <a href="{{ route('admin.sessions.index') }}" class="{{ request()->routeIs('admin.sessions*') ? 'active' : '' }}">◈ Sessions</a>
        <a href="{{ route('admin.bookings.index') }}" class="{{ request()->routeIs('admin.bookings*') ? 'active' : '' }}">◈ Bookings</a>
        <div class="sidebar-label">Shop</div>
        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">◈ Products</a>
        <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">◈ Orders</a>
        <div class="sidebar-label">Site</div>
        <a href="{{ route('home') }}" target="_blank">◈ View Site ↗</a>
    </div>
    <div class="sidebar-footer">
        <p>{{ auth()->user()->name }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Sign Out</button>
        </form>
    </div>
</aside>
<div class="admin-main">
    <header class="admin-header">
        <div>
            <div class="breadcrumb">Admin / @yield('breadcrumb', 'Dashboard')</div>
            <h1>@yield('title', 'Dashboard')</h1>
        </div>
        <div>@yield('header-action')</div>
    </header>
    <div class="admin-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
</div>
@stack('scripts')
</body>
</html>