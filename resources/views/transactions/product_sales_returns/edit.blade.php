@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Sales Return</h1>

        <form action="{{ route('product_sales_returns.update', $productSalesReturn) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    value="{{ $productSalesReturn->product_name }}" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                    value="{{ $productSalesReturn->quantity }}" required min="1">
            </div>
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name"
                    value="{{ $productSalesReturn->customer_name }}" required>
            </div>
            <div class="form-group">
                <label for="return_reason">Return Reason</label>
                <textarea class="form-control" id="return_reason" name="return_reason">{{ $productSalesReturn->return_reason }}</textarea>
            </div>
            <div class="form-group">
                <label for="return_date">Return Date</label>
                <input type="date" class="form-control" id="return_date" name="return_date"
                    value="{{ $productSalesReturn->return_date }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
