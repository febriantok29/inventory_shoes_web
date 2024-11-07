@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Stock Transaction</h1>

        <form action="{{ route('product_stock_transactions.store') }}" method="POST">
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
                <label for="transaction_type">Transaction Type</label>
                <select class="form-control" id="transaction_type" name="transaction_type" required>
                    <option value="addition">Addition</option>
                    <option value="reduction">Reduction</option>
                </select>
            </div>
            <div class="form-group">
                <label for="transaction_date">Transaction Date</label>
                <input type="date" class="form-control" id="transaction_date" name="transaction_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
