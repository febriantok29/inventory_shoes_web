@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product Purchases</h1>
        <a href="{{ route('product_purchases.create') }}" class="btn btn-primary mb-3">Add New Purchase</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Purchase Price</th>
                    <th>Supplier Name</th>
                    <th>Purchase Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productPurchases as $purchase)
                    <tr>
                        <td>{{ $purchase->product_name }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>{{ number_format($purchase->purchase_price, 2) }}</td>
                        <td>{{ $purchase->supplier_name }}</td>
                        <td>{{ $purchase->purchase_date }}</td>
                        <td>
                            <a href="{{ route('product_purchases.show', $purchase) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('product_purchases.edit', $purchase) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('product_purchases.destroy', $purchase) }}" method="POST"
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
