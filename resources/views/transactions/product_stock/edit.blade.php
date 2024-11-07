@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Stock Transaction</h1>

        <form action="{{ route('product_stock_transactions.update', $productStockTransaction) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    value="{{ $productStockTransaction->product_name }}" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                    value="{{ $productStockTransaction->quantity }}" required min="1">
            </div>
            <div class="form-group">
                <label for="transaction_type">Transaction Type</label>
                <select class="form-control" id="transaction_type" name="transaction_type" required>
                    <option value="addition"
                        {{ $productStockTransaction->transaction_type == 'addition' ? 'selected' : '' }}>Addition</option>
                    <option value="reduction"
                        {{ $productStockTransaction->transaction_type == 'reduction' ? 'selected' : '' }}>Reduction</option>
                </select>
            </div>
            <div class="form-group">
                <label for="transaction_date">Transaction Date</label>
                <input type="date" class="form-control" id="transaction_date" name="transaction_date"
                    value="{{ $productStockTransaction->transaction_date }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
