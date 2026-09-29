@extends('layouts.admin')
@section('title', 'New Session')
@section('breadcrumb', 'Sessions / New')

@section('content')
<div class="panel">
    <div class="panel-header"><h2>Create Studio Session</h2></div>
    <div class="panel-body">
        <form method="POST" action="{{ route('admin.sessions.store') }}">
            @csrf
            <div class="grid-2">
                <div class="form-group"><label>Session Title</label><input type="text" name="title" value="{{ old('title') }}" required>@error('title')<div class="form-error">{{ $message }}</div>@enderror</div>
                <div class="form-group"><label>Duration (e.g. "2 hours")</label><input type="text" name="duration" value="{{ old('duration') }}" required></div>
            </div>
            <div class="form-group"><label>Description</label><textarea name="description" rows="4" required>{{ old('description') }}</textarea></div>
            <div class="grid-3">
                <div class="form-group"><label>Price (RM)</label><input type="number" name="price" step="0.01" min="0" value="{{ old('price') }}" required></div>
                <div class="form-group"><label>Max Slots</label><input type="number" name="max_slots" min="1" value="{{ old('max_slots', 5) }}" required></div>
                <div class="form-group"><label>Status</label><select name="is_active"><option value="1" selected>Active</option><option value="0">Inactive</option></select></div>
            </div>
            <button type="submit" class="btn btn-primary">Create Session</button>
            <a href="{{ route('admin.sessions.index') }}" class="btn btn-outline" style="margin-left:0.5rem;">Cancel</a>
        </form>
    </div>
</div>
@endsection