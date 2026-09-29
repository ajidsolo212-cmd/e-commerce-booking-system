@extends('layouts.admin')
@section('title', 'New Product')
@section('breadcrumb', 'Products / New')

@section('content')
<div class="panel">
    <div class="panel-header"><h2>Create Product</h2></div>
    <div class="panel-body">
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf
            <div class="grid-2">
                <div class="form-group"><label>Product Name</label><input type="text" name="name" value="{{ old('name') }}" required>@error('name')<div class="form-error">{{ $message }}</div>@enderror</div>
                <div class="form-group"><label>Category</label>
                    <select name="category" required>
                        <option value="">Select category</option>
                        <option value="film_roll" {{ old('category') === 'film_roll' ? 'selected' : '' }}>Film Roll</option>
                        <option value="print"     {{ old('category') === 'print' ? 'selected' : '' }}>Darkroom Print</option>
                        <option value="accessory" {{ old('category') === 'accessory' ? 'selected' : '' }}>Service & Accessory</option>
                    </select>
                </div>
            </div>
            <div class="form-group"><label>Description</label><textarea name="description" rows="4" required>{{ old('description') }}</textarea></div>
            <div class="grid-3">
                <div class="form-group"><label>Price (RM)</label><input type="number" name="price" step="0.01" min="0" value="{{ old('price') }}" required></div>
                <div class="form-group"><label>Stock</label><input type="number" name="stock" min="0" value="{{ old('stock', 0) }}" required></div>
                <div class="form-group"><label>Status</label><select name="is_active"><option value="1" selected>Active</option><option value="0">Inactive</option></select></div>
            </div>
            <button type="submit" class="btn btn-primary">Create Product</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline" style="margin-left:0.5rem;">Cancel</a>
        </form>
    </div>
</div>
@endsection