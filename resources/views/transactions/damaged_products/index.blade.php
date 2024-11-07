@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Damaged Products</h1>
        <a href="{{ route('damaged_products.create') }}" class="btn btn-primary mb-3">Add New Damaged Product</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Damage Description</th>
                    <th>Quantity</th>
                    <th>Reported Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($damagedProducts as $product)
                    <tr>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->damage_description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->reported_date }}</td>
                        <td>
                            <a href="{{ route('damaged_products.show', $product) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('damaged_products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('damaged_products.destroy', $product) }}" method="POST" class="d-inline">
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
