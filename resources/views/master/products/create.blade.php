@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('page_title', 'Tambah Produk')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Produk</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="code">Kode Produk</label>
                            <input type="text" name="code" id="code" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h3>Detail Produk</h3>
                        <div id="product-details">
                            <div class="product-detail border p-3 mb-3">
                                <div class="form-group">
                                    <label for="details[0][size]">Ukuran</label>
                                    <input type="text" name="details[0][size]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="details[0][color]">Warna</label>
                                    <input type="text" name="details[0][color]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="details[0][stock]">Stok</label>
                                    <input type="number" name="details[0][stock]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="details[0][price]">Harga</label>
                                    <input type="number" name="details[0][price]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="details[0][note]">Catatan</label>
                                    <textarea name="details[0][note]" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-product-detail" class="btn btn-secondary">Tambah Detail Produk</button>
                        <button type="submit" class="btn btn-primary">Simpan Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-product-detail').addEventListener('click', function() {
            const productDetails = document.getElementById('product-details');
            const index = productDetails.children.length;
            const newProductDetail = document.createElement('div');
            newProductDetail.classList.add('product-detail', 'border', 'p-3', 'mb-3');
            newProductDetail.innerHTML = `
                <div class="form-group">
                    <label for="details[${index}][size]">Ukuran</label>
                    <input type="text" name="details[${index}][size]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="details[${index}][color]">Warna</label>
                    <input type="text" name="details[${index}][color]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="details[${index}][stock]">Stok</label>
                    <input type="number" name="details[${index}][stock]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="details[${index}][price]">Harga</label>
                    <input type="number" name="details[${index}][price]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="details[${index}][note]">Catatan</label>
                    <textarea name="details[${index}][note]" class="form-control"></textarea>
                </div>
            `;
            productDetails.appendChild(newProductDetail);
        });
    </script>
@endsection