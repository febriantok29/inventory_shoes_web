@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Product</h1>

        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="code">Product Code</label>
                <input type="text" class="form-control" id="code" name="code" value="{{ $product->code }}"
                    required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}"
                    required min="0" step="0.01">
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}"
                    required min="0">
            </div>
            <div class="form-group">
                <label for="product_category_id">Category</label>
                <select class="form-control" id="product_category_id" name="product_category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->product_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="supplier_id">Supplier</label>
                <select class="form-control" id="supplier_id" name="supplier_id">
                    <option value="">No Supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
