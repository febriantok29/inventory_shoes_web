@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('content')
    <div class="container">
        <h1>Tambah Penjualan</h1>
        <form action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="customer_name" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" name="customer_name" required>
            </div>

            <h3>Detail Produk</h3>
            <div id="sale-details">
                <div class="sale-detail mb-3">
                    <label>Produk:</label>
                    <select name="details[0][product_id]" class="form-select" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>

                    <label>Jumlah:</label>
                    <input type="number" name="details[0][quantity]" class="form-control" min="1" required>

                    <label>Harga:</label>
                    <input type="number" name="details[0][price]" class="form-control" step="0.01" required>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" onclick="addSaleDetail()">Tambah Produk</button>
            <button type="submit" class="btn btn-primary">Simpan Penjualan</button>
        </form>
    </div>

    <script>
        function addSaleDetail() {
            const container = document.getElementById('sale-details');
            const index = container.children.length;
            const template = `
        <div class="sale-detail mb-3">
            <label>Produk:</label>
            <select name="details[${index}][product_id]" class="form-select" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <label>Jumlah:</label>
            <input type="number" name="details[${index}][quantity]" class="form-control" min="1" required>
            <label>Harga:</label>
            <input type="number" name="details[${index}][price]" class="form-control" step="0.01" required>
        </div>`;
            container.insertAdjacentHTML('beforeend', template);
        }
    </script>
@endsection
