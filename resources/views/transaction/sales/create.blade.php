@extends('layouts.app')

@section('title', 'Tambah Transaksi Penjualan')

@section('content')
    <div class="container">
        <h1>Tambah Transaksi Penjualan</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="transaction_date">Tanggal Transaksi</label>
                <input type="date" name="transaction_date" id="transaction_date" class="form-control"
                    value="{{ old('transaction_date', date('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
                <label for="customer_money">Uang Pelanggan</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">RP</span>
                    </div>
                    <input type="number" name="customer_money" id="customer_money" class="form-control"
                        value="{{ old('customer_money', 0) }}" required>
                </div>
            </div>

            <h3>Detail Produk</h3>
            <div class="form-group">
                <label for="product_search">Cari Produk</label>
                <input type="text" id="product_search" class="form-control" placeholder="Masukkan nama atau kode produk">
            </div>
            <div id="product-list" class="mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Ukuran</th>
                            <th>Warna</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="product-list-body">
                        <!-- Product list will be added here dynamically -->
                    </tbody>
                </table>
            </div>

            <h3>Transaction Detail</h3>
            <div id="transaction-details">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Ukuran</th>
                            <th>Warna</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="transaction-details-body">
                        <!-- Transaction details will be added here dynamically -->
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        </form>
    </div>

    <script>
        const productDetails = @json($productDetails);

        document.getElementById('product_search').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase().trim();
            if (searchValue === '') {
                return;
            }

            const filteredProducts = productDetails.filter(productDetail =>
                productDetail.product && (
                    productDetail.product.name.toLowerCase().includes(searchValue) ||
                    productDetail.product.code.toLowerCase().includes(searchValue)
                )
            );

            const productListBody = document.getElementById('product-list-body');
            productListBody.innerHTML = '';

            filteredProducts.forEach((productDetail, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${productDetail.product.name}</td>
                    <td>${productDetail.size}</td>
                    <td>${productDetail.color}</td>
                    <td>${formatRupiah(productDetail.price)}</td>
                    <td>${productDetail.stock}</td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm add-product-detail" data-id="${productDetail.id}" ${productDetail.stock === 0 ? 'disabled' : ''}>+</button>
                    </td>
                `;
                productListBody.appendChild(row);
            });

            document.querySelectorAll('.add-product-detail').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const productDetail = productDetails.find(detail => detail.id == id);
                    addProductToTransactionDetails(productDetail);
                    document.getElementById('product_search').value = ''; // Clear the search field
                });
            });
        });

        function addProductToTransactionDetails(productDetail) {
            const transactionDetailsBody = document.getElementById('transaction-details-body');
            const index = transactionDetailsBody.children.length;
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${productDetail.product.name}</td>
                <td>${productDetail.size}</td>
                <td>${productDetail.color}</td>
                <td>${formatRupiah(productDetail.price)}</td>
                <td>${productDetail.stock}</td>
                <td>
                    <input type="number" name="details[${index}][quantity]" class="form-control" min="1" max="${productDetail.stock}" required>
                    <input type="hidden" name="details[${index}][product_detail_id]" value="${productDetail.id}">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-product-detail">-</button>
                </td>
            `;
            transactionDetailsBody.appendChild(row);

            document.querySelectorAll('.remove-product-detail').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('tr').remove();
                });
            });
        }

        function formatRupiah(amount) {
            return 'RP ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>
@endsection
