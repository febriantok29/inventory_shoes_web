@extends('layouts.app')

@section('title', 'Edit Penjualan')

@section('content')
    <div class="container">
        <h1>Edit Penjualan</h1>
        <form action="{{ route('sales.update', $sale->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="customer_name" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" name="customer_name" value="{{ $sale->customer_name }}" required>
            </div>

            <h3>Detail Produk</h3>
            <div id="sale-details">
                @foreach ($sale->details as $i => $detail)
                    <div class="sale-detail mb-3">
                        <label>Produk:</label>
                        <select name="details[{{ $i }}][product_id]" class="form-select" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ $product->id == $detail->product_id ? 'selected' : '' }}>{{ $product->name }}
                                </option>
                            @endforeach
                        </select>

                        <label>Jumlah:</label>
                        <input type="number" name="details[{{ $i }}][quantity]" class="form-control"
                            min="1" value="{{ $detail->quantity }}" required>

                        <label>Harga:</label>
                        <input type="number" name="details[{{ $i }}][price]" class="form-control" step="0.01"
                            value="{{ $detail->price }}" required>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-secondary" onclick="addSaleDetail()">Tambah Produk</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
