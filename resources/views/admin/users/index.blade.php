@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Users</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <!-- Botón de Ver -->
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info">View</a>

                                <!-- Botón de Editar -->
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                
                                <!-- Botón de Eliminar con Confirmación -->
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $user->id }})">Delete</button>
                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
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
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create User</a>
            <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>

<script>
    function confirmDelete(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            document.getElementById('delete-form-' + userId).submit();
        }
    }
</script>
@endsection

