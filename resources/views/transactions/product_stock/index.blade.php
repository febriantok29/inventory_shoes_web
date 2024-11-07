@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product Stock Transactions</h1>
        <a href="{{ route('product_stock_transactions.create') }}" class="btn btn-primary mb-3">Add New Stock Transaction</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Transaction Type</th>
                    <th>Transaction Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stockTransactions as $transaction)
                    <tr>
                        <td>{{ $transaction->product_name }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>{{ ucfirst($transaction->transaction_type) }}</td>
                        <td>{{ $transaction->transaction_date }}</td>
                        <td>
                            <a href="{{ route('product_stock_transactions.show', $transaction) }}"
                                class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('product_stock_transactions.edit', $transaction) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('product_stock_transactions.destroy', $transaction) }}" method="POST"
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
