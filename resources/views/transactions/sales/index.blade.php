@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sales Transactions</h1>
        <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">Add New Sale</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->sale_date }}</td>
                        <td>{{ $sale->customer_name }}</td>
                        <td>{{ $sale->total_amount }}</td>
                        <td>
                            <a href="{{ route('sales.show', $sale) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('sales.edit', $sale) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="d-inline">
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
