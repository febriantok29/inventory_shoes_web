@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product Category Details</h1>
        <div>
            <strong>Name:</strong> {{ $productCategory->name }}
        </div>
        <div>
            <strong>Description:</strong> {{ $productCategory->description }}
        </div>
        <a href="{{ route('product_categories.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
