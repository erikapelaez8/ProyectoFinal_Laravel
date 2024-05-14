@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $product->name }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/images/products/' . $product->image) }}"  class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <h4>Brand: {{ $product->brand }}</h4>
                            <p><strong>Color:</strong> {{ $product->color }}</p>
                            <p><strong>Price:</strong> ${{ $product->price }}</p>
                            <p><strong>Description:</strong> {{ $product->description }}</p>
                            <p><strong>Stock:</strong> {{ $product->stock }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="/"  class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
