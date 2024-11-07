@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Stock Transaction Details</h1>
        <div>
            <strong>Product Name:</strong> {{ $productStockTransaction->product_name }}
        </div>
        <div>
            <strong>Quantity:</strong> {{ $productStockTransaction->quantity }}
        </div>
        <div>
            <strong>Transaction Type:</strong> {{ ucfirst($productStockTransaction->transaction_type) }}
        </div>
        <div>
            <strong>Transaction Date:</strong> {{ $productStockTransaction->transaction_date }}
        </div>
        <a href="{{ route('product_stock_transactions.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
