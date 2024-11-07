@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product Categories</h1>
        <a href="{{ route('product_categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('product_categories.show', $category) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('product_categories.edit', $category) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('product_categories.destroy', $category) }}" method="POST"
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
