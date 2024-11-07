@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sale Details</h1>
        <div>
            <strong>Date:</strong> {{ $sale->sale_date }}
        </div>
        <div>
            <strong>Customer Name:</strong> {{ $sale->customer_name }}
        </div>
        <div>
            <strong>Total Amount:</strong> {{ $sale->total_amount }}
        </div>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
