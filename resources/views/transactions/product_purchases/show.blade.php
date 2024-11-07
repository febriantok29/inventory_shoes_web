@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product Purchase Details</h1>
        <div>
            <strong>Product Name:</strong> {{ $productPurchase->product_name }}
        </div>
        <div>
            <strong>Quantity:</strong> {{ $productPurchase->quantity }}
        </div>
        <div>
            <strong>Purchase Price:</strong> {{ number_format($productPurchase->purchase_price, 2) }}
        </div>
        <div>
            <strong>Supplier Name:</strong> {{ $productPurchase->supplier_name }}
        </div>
        <div>
            <strong>Purchase Date:</strong> {{ $productPurchase->purchase_date }}
        </div>
        <a href="{{ route('product_purchases.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
