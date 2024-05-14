@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Categories</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <!-- Botón de Editar -->
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                                
                                <!-- Botón de Eliminar con Confirmación -->
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $category->id }})">Delete</button>
                                <form id="delete-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mb-3">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create Category</a>
            <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
                       
</div>

<script>
    function confirmDelete(categoryId) {
        if (confirm('Are you sure you want to delete this category?')) {
            document.getElementById('delete-form-' + categoryId).submit();
        }
    }
</script>
@endsection
