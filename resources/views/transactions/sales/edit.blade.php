@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Sale</h1>

        <form action="{{ route('sales.update', $sale) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="sale_date">Sale Date</label>
                <input type="date" class="form-control" id="sale_date" name="sale_date" value="{{ $sale->sale_date }}"
                    required>
            </div>
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name"
                    value="{{ $sale->customer_name }}" required>
            </div>
            <div class="form-group">
                <label for="total_amount">Total Amount</label>
                <input type="number" class="form-control" id="total_amount" name="total_amount"
                    value="{{ $sale->total_amount }}" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
