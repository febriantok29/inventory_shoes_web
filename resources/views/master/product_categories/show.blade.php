@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Detail Kategori Produk</h1>

        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Kategori</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $productCategory->name }}" placeholder="Masukkan nama kategori" required readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="code">SKU</label>
                    <input type="text" class="form-control" id="code" name="code"
                        value="{{ $productCategory->code }}" placeholder="Masukkan SKU" required readonly>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="description">Keterangan</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    placeholder="Masukkan keterangan kategori (opsional)" readonly>{{ $productCategory->description }}</textarea>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('product_categories.index') }}" class="btn btn-primary px-5">Kembali</a>
        </div>
    </div>
@endsection
