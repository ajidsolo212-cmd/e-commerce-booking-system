@extends('layouts.app')
@section('title', 'Create Account')

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
        <div class="auth-eyebrow">⬡ Join Grainhaus</div>
        <h2>Start your <em>analog</em> journey.</h2>
        <p>Create an account to book studio sessions, order film, and commission darkroom prints — all in one place.</p>
    </div>
    <div class="auth-right">
        <div style="font-size:2rem;font-weight:300;color:var(--white);margin-bottom:0.5rem;">Create Account</div>
        <div style="color:var(--muted);font-size:0.9rem;margin-bottom:2.5rem;">Already have one? <a href="{{ route('login') }}" style="color:var(--amber);text-decoration:none;">Sign in here</a></div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Phone Number <span style="color:var(--muted);font-size:0.55rem;">(optional)</span></label>
                <input type="text" name="phone" value="{{ old('phone') }}">
                @error('phone')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Password <span style="color:var(--muted);font-size:0.55rem;">(min. 8 characters)</span></label>
                <input type="password" name="password" required>
                @error('password')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;margin-top:0.5rem;">Create Account</button>
        </form>
    </div>
</div>
@endsection