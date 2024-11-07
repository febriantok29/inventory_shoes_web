@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Product Purchase</h1>

        <form action="{{ route('product_purchases.update', $productPurchase) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    value="{{ $productPurchase->product_name }}" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                    value="{{ $productPurchase->quantity }}" required min="1">
            </div>
            <div class="form-group">
                <label for="purchase_price">Purchase Price</label>
                <input type="number" class="form-control" id="purchase_price" name="purchase_price"
                    value="{{ $productPurchase->purchase_price }}" required min="0" step="0.01">
            </div>
            <div class="form-group">
                <label for="supplier_name">Supplier Name</label>
                <input type="text" class="form-control" id="supplier_name" name="supplier_name"
                    value="{{ $productPurchase->supplier_name }}" required>
            </div>
            <div class="form-group">
                <label for="purchase_date">Purchase Date</label>
                <input type="date" class="form-control" id="purchase_date" name="purchase_date"
                    value="{{ $productPurchase->purchase_date }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
