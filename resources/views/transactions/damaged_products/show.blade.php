@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Damaged Product Details</h1>
        <div>
            <strong>Product Name:</strong> {{ $damagedProduct->product_name }}
        </div>
        <div>
            <strong>Damage Description:</strong> {{ $damagedProduct->damage_description }}
        </div>
        <div>
            <strong>Quantity:</strong> {{ $damagedProduct->quantity }}
        </div>
        <div>
            <strong>Reported Date:</strong> {{ $damagedProduct->reported_date }}
        </div>
        <a href="{{ route('damaged_products.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
