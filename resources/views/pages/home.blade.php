@extends('layouts.app')
@section('title', 'Grainhaus')

@push('head')
<style>
    .hero { min-height: calc(100vh - 68px); display: flex; flex-direction: column; justify-content: flex-end; padding: 4rem 3rem; position: relative; overflow: hidden; border-bottom: 1px solid var(--border); }
    .hero-bg { position: absolute; inset: 0; background: radial-gradient(ellipse 60% 80% at 70% 30%, rgba(200,147,58,0.06) 0%, transparent 60%), radial-gradient(ellipse 40% 50% at 20% 80%, rgba(200,147,58,0.04) 0%, transparent 50%); }
    .hero-eyebrow { font-family: 'Space Mono', monospace; font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: var(--amber); margin-bottom: 1.5rem; position: relative; }
    .hero h1 { font-size: clamp(3.5rem, 8vw, 7rem); font-weight: 300; line-height: 1.0; letter-spacing: -0.03em; color: var(--white); margin-bottom: 2rem; position: relative; }
    .hero h1 em { font-style: italic; color: var(--amber-l); }
    .hero-sub { max-width: 480px; color: var(--muted); font-size: 1.05rem; line-height: 1.8; margin-bottom: 3rem; position: relative; }
    .hero-actions { display: flex; gap: 1rem; position: relative; }
    .services { padding: 6rem 3rem; border-bottom: 1px solid var(--border); }
    .section-label { font-family: 'Space Mono', monospace; font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--amber); margin-bottom: 3rem; display: flex; align-items: center; gap: 1rem; }
    .section-label::after { content: ''; flex: 1; height: 1px; background: var(--border); }
    .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; background: var(--border); }
    .service-item { background: var(--black); padding: 3rem 2.5rem; transition: background 0.2s; }
    .service-item:hover { background: var(--surface); }
    .service-num { font-family: 'Space Mono', monospace; font-size: 0.65rem; color: var(--muted); letter-spacing: 0.1em; margin-bottom: 1.5rem; }
    .service-item h3 { font-size: 1.6rem; font-weight: 300; color: var(--white); margin-bottom: 1rem; line-height: 1.2; }
    .service-item p  { color: var(--muted); font-size: 0.9rem; line-height: 1.8; margin-bottom: 1.5rem; }
    .service-link { font-family: 'Space Mono', monospace; font-size: 0.6rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--amber); text-decoration: none; display: flex; align-items: center; gap: 0.5rem; transition: gap 0.2s; }
    .service-link:hover { gap: 0.9rem; }
    .about-strip { padding: 6rem 3rem; display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center; border-bottom: 1px solid var(--border); }
    .about-strip h2 { font-size: 2.8rem; font-weight: 300; line-height: 1.15; color: var(--white); margin-bottom: 1.5rem; }
    .about-strip h2 em { font-style: italic; color: var(--amber-l); }
    .about-strip p { color: var(--muted); line-height: 1.9; margin-bottom: 1rem; }
    .film-numbers { display: grid; grid-template-columns: 1fr 1fr; gap: 1px; background: var(--border); }
    .film-num-item { background: var(--surface); padding: 2rem; }
    .film-num-item .num { font-size: 3rem; font-weight: 300; color: var(--amber); line-height: 1; }
    .film-num-item .num-label { font-family: 'Space Mono', monospace; font-size: 0.6rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted); margin-top: 0.4rem; }
    @media (max-width: 768px) {
        .hero { padding: 3rem 1.5rem; }
        .services { padding: 4rem 1.5rem; }
        .services-grid { grid-template-columns: 1fr; }
        .about-strip { grid-template-columns: 1fr; gap: 3rem; padding: 4rem 1.5rem; }
    }
</style>
@endpush

@section('content')
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-eyebrow">Kuala Lumpur · Est. 2019 · 35mm & 120</div>
    <h1>The art of<br><em>slow</em> light.</h1>
    <p class="hero-sub">Grainhaus is a boutique film photography studio. We shoot on analog, develop in-house, and print in the darkroom. Every frame is irreversible — and that's the point.</p>
    <div class="hero-actions">
        <a href="{{ route('booking.index') }}" class="btn btn-primary">Book a Session</a>
        <a href="{{ route('shop.index') }}" class="btn btn-outline">Film Shop</a>
    </div>
</section>

<section class="services">
    <div class="section-label">What we offer</div>
    <div class="services-grid">
        <div class="service-item">
            <div class="service-num">01</div>
            <h3>Studio Sessions</h3>
            <p>Portrait, editorial, darkroom experience. Each session is designed around the ritual of film photography — unhurried, intentional.</p>
            <a href="{{ route('booking.index') }}" class="service-link">Book now →</a>
        </div>
        <div class="service-item">
            <div class="service-num">02</div>
            <h3>Film & Supplies</h3>
            <p>Curated selection of 35mm and 120 film. Kodak, Ilford, Fuji, Cinestill. Sourced for the particular and the curious.</p>
            <a href="{{ route('shop.index') }}?category=film_roll" class="service-link">Shop film →</a>
        </div>
        <div class="service-item">
            <div class="service-num">03</div>
            <h3>Darkroom Prints</h3>
            <p>Silver gelatin prints made by hand. Each print is unique — no two are exactly alike. Order prints from your own negatives or from our archive.</p>
            <a href="{{ route('shop.index') }}?category=print" class="service-link">Order prints →</a>
        </div>
    </div>
</section>

<section class="about-strip">
    <div>
        <h2>Film is not a <em>medium.</em><br>It's a commitment.</h2>
        <p>We built Grainhaus for photographers who understand that the constraint of 36 frames is not a limitation — it's a discipline.</p>
        <p>Every session at our studio is developed and scanned in-house. Our darkroom prints are made on fiber-based paper, archival and handmade.</p>
        <br>
        <a href="{{ route('about') }}" class="btn btn-outline">Our story</a>
    </div>
    <div>
        <div class="film-numbers">
            <div class="film-num-item"><div class="num">36</div><div class="num-label">Frames per roll</div></div>
            <div class="film-num-item"><div class="num">500+</div><div class="num-label">Sessions shot</div></div>
            <div class="film-num-item"><div class="num">12</div><div class="num-label">Film stocks</div></div>
            <div class="film-num-item"><div class="num">4</div><div class="num-label">Years analog</div></div>
        </div>
    </div>
</section>
@endsection