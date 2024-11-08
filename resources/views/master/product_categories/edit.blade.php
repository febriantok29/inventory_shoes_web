@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Perbarui Kategori</h1>

        <form action="{{ route('product_categories.update', $productCategory) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Kategori</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $productCategory->name }}" placeholder="Masukkan nama kategori" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="code">SKU</label>
                        <input type="text" class="form-control" id="code" name="code"
                            value="{{ $productCategory->code }}" placeholder="Masukkan SKU" required>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="description">Keterangan</label>
                    <textarea class="form-control" id="description" name="description" rows="3"
                        placeholder="Masukkan keterangan kategori (opsional)">{{ $productCategory->description }}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('product_categories.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
