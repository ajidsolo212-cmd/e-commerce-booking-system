@extends('layouts.app')
@section('title', 'Contact')

@section('content')
<div class="page-header">
    <div class="eyebrow">Get in touch</div>
    <h1>Contact <em>us</em></h1>
</div>
<div class="container section">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:5rem;">
        <div>
            <div style="font-family:'Space Mono',monospace;font-size:0.6rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--amber);margin-bottom:2rem;">Studio Information</div>
            @foreach([['Address','12, Jalan Telawi 2, Bangsar, 59100 Kuala Lumpur'],['Email','hello@grainhaus.my'],['Phone','+60 12-345 6789'],['Hours',"Tuesday – Saturday\n10:00 AM – 6:00 PM"]] as [$label,$val])
            <div style="margin-bottom:2rem;padding-bottom:2rem;border-bottom:1px solid var(--border);">
                <div style="font-family:'Space Mono',monospace;font-size:0.58rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--muted);margin-bottom:0.4rem;">{{ $label }}</div>
                <div style="white-space:pre-line;line-height:1.8;">{{ $val }}</div>
            </div>
            @endforeach
            <a href="{{ route('booking.index') }}" class="btn btn-primary">Book a Session →</a>
        </div>
        <div>
            <div style="font-family:'Space Mono',monospace;font-size:0.6rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--amber);margin-bottom:2rem;">Send a message</div>
            <form>
                <div class="form-group"><label>Your Name</label><input type="text" placeholder="Full name"></div>
                <div class="form-group"><label>Email</label><input type="email" placeholder="your@email.com"></div>
                <div class="form-group"><label>Message</label><textarea rows="5" placeholder="Tell us what you need..."></textarea></div>
                <button type="submit" class="btn btn-primary">Send Message →</button>
            </form>
        </div>
    </div>
</div>
@endsection