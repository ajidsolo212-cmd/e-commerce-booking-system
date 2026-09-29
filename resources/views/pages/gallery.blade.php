@extends('layouts.app')
@section('title', 'Gallery')

@push('head')
<style>
    .gallery-grid { columns: 3; column-gap: 2px; padding: 3rem; }
    .gallery-item { break-inside: avoid; margin-bottom: 2px; background: var(--surface); border: 1px solid var(--border); aspect-ratio: var(--ar, 3/4); display: flex; align-items: center; justify-content: center; }
    .gallery-placeholder { font-family: 'Space Mono', monospace; font-size: 0.6rem; letter-spacing: 0.12em; color: var(--muted); text-align: center; }
    .gallery-item:nth-child(3n+1) { --ar: 3/4; }
    .gallery-item:nth-child(3n+2) { --ar: 4/3; }
    .gallery-item:nth-child(3n)   { --ar: 1/1; }
    @media (max-width: 768px) { .gallery-grid { columns: 2; padding: 1.5rem; } }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="eyebrow">Portfolio</div>
    <h1>The <em>archive</em></h1>
</div>
<p style="padding:1.5rem 3rem 0;color:var(--muted);max-width:600px;font-size:0.95rem;line-height:1.8;">A selection of work from sessions at the studio. Shot on 35mm and 120 format film. Developed and scanned in-house.</p>
<div class="gallery-grid">
    @for($i = 1; $i <= 12; $i++)
    <div class="gallery-item">
        <div class="gallery-placeholder">FRAME {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</div>
    </div>
    @endfor
</div>
@endsection