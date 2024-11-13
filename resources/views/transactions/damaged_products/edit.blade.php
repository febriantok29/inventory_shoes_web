@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Damaged Product</h1>

        <form action="{{ route('damaged_products.update', $damagedProduct) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    value="{{ $damagedProduct->product_name }}" required>
            </div>
            <div class="form-group">
                <label for="damage_description">Damage Description</label>
                <textarea class="form-control" id="damage_description" name="damage_description">{{ $damagedProduct->damage_description }}</textarea>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                    value="{{ $damagedProduct->quantity }}" required min="1">
            </div>
            <div class="form-group">
                <label for="reported_date">Reported Date</label>
                <input type="date" class="form-control" id="reported_date" name="reported_date"
                    value="{{ $damagedProduct->reported_date }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
