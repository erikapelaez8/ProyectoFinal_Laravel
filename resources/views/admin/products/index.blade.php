@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Products</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Stock</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->color }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="Product Image " style="max-width: 100px;">
                            </td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <!-- Botón de Editar -->
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning me-2">Edit</a>
                                                            
                                    <!-- Botón de Eliminar con Confirmación -->
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $product->id }})">Delete</button>
                                    <form id="delete-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mb-3">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create Product</a>
            <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>

<script>
    function confirmDelete(productId) {
        if (confirm('Are you sure you want to delete this product?')) {
            document.getElementById('delete-form-' + productId).submit();
        }
    }
</script>
@endsection

