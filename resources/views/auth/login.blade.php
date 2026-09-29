@extends('layouts.app')
@section('title', 'Sign In')

@push('head')
<style>
    .auth-wrap { min-height: calc(100vh - 68px); display: grid; grid-template-columns: 1fr 1fr; }
    .auth-left { background: var(--surface); border-right: 1px solid var(--border); padding: 5rem; display: flex; flex-direction: column; justify-content: center; }
    .auth-right { display: flex; flex-direction: column; justify-content: center; padding: 5rem; }
    .auth-eyebrow { font-family: 'Space Mono', monospace; font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--amber); margin-bottom: 1.5rem; }
    .auth-left h2 { font-size: 3rem; font-weight: 300; color: var(--white); line-height: 1.1; margin-bottom: 1.5rem; }
    .auth-left h2 em { font-style: italic; color: var(--amber-l); }
    .auth-left p { color: var(--muted); line-height: 1.9; }
    @media (max-width: 768px) { .auth-wrap { grid-template-columns: 1fr; } .auth-left { display: none; } .auth-right { padding: 3rem 1.5rem; } }
</style>
@endpush

@section('content')
<div class="auth-wrap">
    <div class="auth-left">
        <div class="auth-eyebrow">⬡ Grainhaus Studio</div>
        <h2>Back to the <em>grain.</em></h2>
        <p>Sign in to book sessions, manage your orders, and access your darkroom print history.</p>
    </div>
    <div class="auth-right">
        <div style="font-size:2rem;font-weight:300;color:var(--white);margin-bottom:0.5rem;">Sign In</div>
        <div style="color:var(--muted);font-size:0.9rem;margin-bottom:2.5rem;">No account? <a href="{{ route('register') }}" style="color:var(--amber);text-decoration:none;">Create one here</a></div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group" style="display:flex;align-items:center;gap:0.5rem;">
                <input type="checkbox" name="remember" id="remember" style="width:auto;">
                <label for="remember" style="text-transform:none;font-size:0.8rem;color:var(--muted);margin:0;">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;margin-top:0.5rem;">Sign In</button>
        </form>
    </div>
</div>
@endsection