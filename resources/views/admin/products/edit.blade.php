@extends('layouts.admin')
@section('title', 'Edit Product')
@section('breadcrumb', 'Products / Edit')

@section('content')
<div class="panel">
    <div class="panel-header"><h2>Edit: {{ $product->name }}</h2></div>
    <div class="panel-body">
        <form method="POST" action="{{ route('admin.products.update', $product) }}">
            @csrf @method('PUT')
            <div class="grid-2">
                <div class="form-group"><label>Product Name</label><input type="text" name="name" value="{{ old('name', $product->name) }}" required></div>
                <div class="form-group"><label>Category</label>
                    <select name="category" required>
                        <option value="film_roll" {{ $product->category === 'film_roll' ? 'selected' : '' }}>Film Roll</option>
                        <option value="print"     {{ $product->category === 'print' ? 'selected' : '' }}>Darkroom Print</option>
                        <option value="accessory" {{ $product->category === 'accessory' ? 'selected' : '' }}>Service & Accessory</option>
                    </select>
                </div>
            </div>
            <div class="form-group"><label>Description</label><textarea name="description" rows="4" required>{{ old('description', $product->description) }}</textarea></div>
            <div class="grid-3">
                <div class="form-group"><label>Price (RM)</label><input type="number" name="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" required></div>
                <div class="form-group"><label>Stock</label><input type="number" name="stock" min="0" value="{{ old('stock', $product->stock) }}" required></div>
                <div class="form-group"><label>Status</label><select name="is_active"><option value="1" {{ $product->is_active ? 'selected' : '' }}>Active</option><option value="0" {{ !$product->is_active ? 'selected' : '' }}>Inactive</option></select></div>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline" style="margin-left:0.5rem;">Cancel</a>
        </form>
    </div>
</div>
@endsection