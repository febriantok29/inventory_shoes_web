@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text"><strong>Code:</strong> {{ $product->code }}</p>
                <p class="card-text"><strong>Price:</strong> {{ number_format($product->price, 2) }}</p>
                <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                <p class="card-text"><strong>Category:</strong> {{ $product->category->name }}</p>
                <p class="card-text"><strong>Supplier:</strong> {{ $product->supplier->name ?? 'No Supplier' }}</p>
                <p class="card-text"><strong>Created At:</strong> {{ $product->created_at }}</p>
                <p class="card-text"><strong>Updated At:</strong> {{ $product->updated_at }}</p>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
            </div>
        </div>
    </div>
@endsection
