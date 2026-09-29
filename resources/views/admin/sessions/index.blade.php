@extends('layouts.admin')
@section('title', 'Studio Sessions')
@section('breadcrumb', 'Sessions')
@section('header-action')<a href="{{ route('admin.sessions.create') }}" class="btn btn-primary">+ New Session</a>@endsection

@section('content')
<div class="panel">
    <table>
        <thead><tr><th>Title</th><th>Duration</th><th>Price</th><th>Slots</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($sessions as $s)
            <tr>
                <td>{{ $s->title }}</td>
                <td style="font-family:'Space Mono',monospace;font-size:0.75rem;">{{ $s->duration }}</td>
                <td>RM {{ number_format($s->price, 2) }}</td>
                <td style="font-family:'Space Mono',monospace;font-size:0.75rem;">{{ $s->booked_slots }} / {{ $s->max_slots }}</td>
                <td><span class="badge {{ $s->is_active ? 'badge-confirmed' : 'badge-cancelled' }}">{{ $s->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td>
                    <a href="{{ route('admin.sessions.edit', $s) }}" class="btn btn-outline btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.sessions.destroy', $s) }}" style="display:inline;" onsubmit="return confirm('Delete this session?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="color:var(--muted);font-style:italic;">No sessions yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection