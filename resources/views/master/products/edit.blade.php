@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Perbarui Sepatu</h1>

        @if ($errors->any() || session('error'))
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @if (session('error'))
                        <li>{{ session('error') }}</li>
                    @endif
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Nama Sepatu</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $product->name) }}" placeholder="Masukkan nama sepatu" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="code">SKU</label>
                    <input type="text" class="form-control" id="code" name="code"
                        value="{{ old('code', $product->code) }}" placeholder="Masukkan SKU sepatu" required disabled>
                    <small class="form-text text-muted">SKU tidak dapat diubah.</small>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="product_category_id">Kategori</label>
                    <select class="form-control" id="product_category_id" name="product_category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="supplier_id">Pemasok</label>
                    <select class="form-control" id="supplier_id" name="supplier_id">
                        <option value="">No Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="size">Ukuran</label>
                    <input type="text" class="form-control" id="size" name="size"
                        value="{{ old('size', $product->size) }}" placeholder="Masukkan ukuran sepatu" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="color">Warna</label>
                    <input list="colors" class="form-control" id="color" name="color"
                        value="{{ old('color', $product->color) }}" placeholder="Masukkan warna sepatu" required>
                    <datalist id="colors">
                        <option value="Merah">
                        <option value="Biru">
                        <option value="Hijau">
                        <option value="Kuning">
                        <option value="Hitam">
                        <option value="Putih">
                    </datalist>
                </div>
            </div>

            <div class="form-group">
                <label for="price">Harga</label>
                <input type="number" class="form-control" id="price" name="price"
                    value="{{ old('price', $product->price) }}" placeholder="Masukkan harga sepatu" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    placeholder="Masukkan deskripsi sepatu" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success px-5">Perbarui</button>
            </div>
        </form>
    </div>
@endsection
