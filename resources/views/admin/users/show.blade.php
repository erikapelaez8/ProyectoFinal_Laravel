@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    User Details
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ID:</strong> {{ $user->id }}</li>
                        <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                        <li class="list-group-item"><strong>Created At:</strong> {{ $user->created_at }}</li>
                        <li class="list-group-item"><strong>Updated At:</strong> {{ $user->updated_at }}</li>
                    </ul>
                    <div class="mt-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection
