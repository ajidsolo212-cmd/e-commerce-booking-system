@extends('layouts.admin')
@section('title', 'Products')
@section('breadcrumb', 'Products')
@section('header-action')<a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ New Product</a>@endsection

@section('content')
<div class="panel">
    <table>
        <thead><tr><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($products as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td><span class="badge badge-pending">{{ $p->category_label }}</span></td>
                <td>RM {{ number_format($p->price, 2) }}</td>
                <td style="font-family:'Space Mono',monospace;">{{ $p->stock }}</td>
                <td><span class="badge {{ $p->is_active ? 'badge-confirmed' : 'badge-cancelled' }}">{{ $p->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td>
                    <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-outline btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $p) }}" style="display:inline;" onsubmit="return confirm('Delete this product?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="color:var(--muted);font-style:italic;">No products yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection