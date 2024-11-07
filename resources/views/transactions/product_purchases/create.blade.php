@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Product Purchase</h1>

        <form action="{{ route('product_purchases.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required min="1">
            </div>
            <div class="form-group">
                <label for="purchase_price">Purchase Price</label>
                <input type="number" class="form-control" id="purchase_price" name="purchase_price" required min="0"
                    step="0.01">
            </div>
            <div class="form-group">
                <label for="supplier_name">Supplier Name</label>
                <input type="text" class="form-control" id="supplier_name" name="supplier_name" required>
            </div>
            <div class="form-group">
                <label for="purchase_date">Purchase Date</label>
                <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
