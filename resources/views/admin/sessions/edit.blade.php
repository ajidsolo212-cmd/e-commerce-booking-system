@extends('layouts.admin')
@section('title', 'Edit Session')
@section('breadcrumb', 'Sessions / Edit')

@section('content')
<div class="panel">
    <div class="panel-header"><h2>Edit: {{ $session->title }}</h2></div>
    <div class="panel-body">
        <form method="POST" action="{{ route('admin.sessions.update', $session) }}">
            @csrf @method('PUT')
            <div class="grid-2">
                <div class="form-group"><label>Session Title</label><input type="text" name="title" value="{{ old('title', $session->title) }}" required></div>
                <div class="form-group"><label>Duration</label><input type="text" name="duration" value="{{ old('duration', $session->duration) }}" required></div>
            </div>
            <div class="form-group"><label>Description</label><textarea name="description" rows="4" required>{{ old('description', $session->description) }}</textarea></div>
            <div class="grid-3">
                <div class="form-group"><label>Price (RM)</label><input type="number" name="price" step="0.01" min="0" value="{{ old('price', $session->price) }}" required></div>
                <div class="form-group"><label>Max Slots</label><input type="number" name="max_slots" min="{{ $session->booked_slots }}" value="{{ old('max_slots', $session->max_slots) }}" required></div>
                <div class="form-group"><label>Status</label><select name="is_active"><option value="1" {{ $session->is_active ? 'selected' : '' }}>Active</option><option value="0" {{ !$session->is_active ? 'selected' : '' }}>Inactive</option></select></div>
            </div>
            <button type="submit" class="btn btn-primary">Update Session</button>
            <a href="{{ route('admin.sessions.index') }}" class="btn btn-outline" style="margin-left:0.5rem;">Cancel</a>
        </form>
    </div>
</div>
@endsection