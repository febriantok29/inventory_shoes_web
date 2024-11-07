@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sales Return Details</h1>
        <div>
            <strong>Product Name:</strong> {{ $productSalesReturn->product_name }}
        </div>
        <div>
            <strong>Quantity:</strong> {{ $productSalesReturn->quantity }}
        </div>
        <div>
            <strong>Customer Name:</strong> {{ $productSalesReturn->customer_name }}
        </div>
        <div>
            <strong>Return Reason:</strong> {{ $productSalesReturn->return_reason }}
        </div>
        <div>
            <strong>Return Date:</strong> {{ $productSalesReturn->return_date }}
        </div>
        <a href="{{ route('product_sales_returns.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
