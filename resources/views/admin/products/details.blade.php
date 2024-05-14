@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    {{ $product->name }}
                </div>

                <div class="card-body">
                    <img src="{{ asset('storage/images/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Brand: {{ $product->brand }}</p>
                    <p class="card-text">Color: {{ $product->color }}</p>
                    <p class="card-text">Price: ${{ $product->price }}</p>
                    <p class="card-text">Description: {{ $product->description }}</p>
                    <p class="card-text">Stock: {{ $product->stock }}</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
