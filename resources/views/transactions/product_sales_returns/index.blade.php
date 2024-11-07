@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product Sales Returns</h1>
        <a href="{{ route('product_sales_returns.create') }}" class="btn btn-primary mb-3">Add New Sales Return</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Customer Name</th>
                    <th>Return Reason</th>
                    <th>Return Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productSalesReturns as $return)
                    <tr>
                        <td>{{ $return->product_name }}</td>
                        <td>{{ $return->quantity }}</td>
                        <td>{{ $return->customer_name }}</td>
                        <td>{{ $return->return_reason }}</td>
                        <td>{{ $return->return_date }}</td>
                        <td>
                            <a href="{{ route('product_sales_returns.show', $return) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('product_sales_returns.edit', $return) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('product_sales_returns.destroy', $return) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
