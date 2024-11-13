@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Tambah Sepatu Baru</h1>

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

        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Nama Sepatu</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Masukkan nama sepatu" value="{{ old('name') }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="code">SKU</label>
                    <input type="text" class="form-control" id="code" name="code"
                        placeholder="Masukkan SKU sepatu" value="{{ old('code') }}" required>

                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="product_category_id">Kategori</label>
                    <select class="form-control" id="product_category_id" name="product_category_id" required>
                        <option selected>Sila Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="supplier_id">Pemasok</label>
                    <select class="form-control" id="supplier_id" name="supplier_id">
                        <option selected>Sila Pilih Pemasok</option>
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
                        placeholder="Masukkan ukuran sepatu" value="{{ old('size') }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="color">Warna</label>
                    <input list="colors" class="form-control" id="color" name="color"
                        placeholder="Masukkan warna sepatu" value="{{ old('color') }}" required>
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
                <input type="number" class="form-control" id="price" name="price" placeholder="Masukkan harga sepatu"
                    value="{{ old('price') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    placeholder="Masukkan deskripsi sepatu" required>{{ old('description') }}</textarea>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success px-5">Simpan</button>
            </div>
        </form>
    </div>
@endsection
