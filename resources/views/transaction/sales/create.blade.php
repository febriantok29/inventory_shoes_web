@extends('layouts.app')

@section('title', 'Tambah Transaksi Penjualan')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Tambah Transaksi Penjualan</h3>
                    <div class="card-tools">
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('sales.store') }}" method="POST" id="sales-form">
                        @csrf

                        {{-- Transaction Date --}}
                        <div class="form-group">
                            <label for="transaction_date">Tanggal Transaksi</label>
                            <input type="date" name="transaction_date" id="transaction_date" class="form-control"
                                value="{{ old('transaction_date', now()->format('Y-m-d')) }}" required>
                        </div>

                        {{-- Customer Money --}}
                        <div class="form-group">
                            <label for="customer_money">Uang Pelanggan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">RP</span>
                                </div>
                                <input type="number" name="customer_money" id="customer_money" class="form-control"
                                    value="{{ old('customer_money', 0) }}" min="0" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="total_price">Total Harga</label>
                            <input type="text" id="total_price" class="form-control" value="RP 0" readonly
                                data-value="0">
                        </div>
                        <div class="form-group">
                            <label for="change">Kembalian</label>
                            <input type="text" id="change" class="form-control" value="RP 0" readonly>
                        </div>

                        {{-- Product Search --}}
                        <h3>Detail Sepatu</h3>
                        <div class="form-group">
                            <label for="product_search">Cari Sepatu</label>
                            <input type="text" id="product_search" class="form-control"
                                placeholder="Masukkan nama atau kode produk">
                        </div>

                        {{-- Product List --}}
                        <div id="product-list" class="mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Sepatu</th>
                                        <th>Ukuran</th>
                                        <th>Warna</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="product-list-body">
                                    <!-- Product list dynamically populated -->
                                </tbody>
                            </table>
                        </div>

                        {{-- Transaction Details --}}
                        <h3>Daftar Sepatu Dibeli</h3>
                        <div id="transaction-details">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Sepatu</th>
                                        <th>Ukuran</th>
                                        <th>Warna</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="transaction-details-body">
                                    <!-- Transaction details dynamically populated -->
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            // Format number to Indonesian Rupiah
            function formatRupiah(amount) {
                return "RP " + amount.toLocaleString("id-ID");
            }

            // Update the total price and change fields
            function updateTotals() {
                const transactionDetailsBody = document.getElementById("transaction-details-body");
                const totalPriceField = document.getElementById("total_price");

                let total = 0;
                Array.from(transactionDetailsBody.children).forEach((row) => {
                    const price = parseFloat(row.querySelector(".price").dataset.value);
                    const quantity = parseInt(row.querySelector(".quantity").value) || 0;
                    total += price * quantity;
                });

                totalPriceField.value = formatRupiah(total);
                totalPriceField.dataset.value = total;
                updateChange();
            }

            function updateChange() {
                const customerMoneyField = document.getElementById("customer_money");
                const totalPriceField = document.getElementById("total_price");
                const changeField = document.getElementById("change");

                const customerMoney = parseFloat(customerMoneyField.value) || 0;
                const total = parseFloat(totalPriceField.dataset.value) || 0;
                const change = Math.max(0, customerMoney - total);

                changeField.value = formatRupiah(change);
            }

            document.addEventListener("DOMContentLoaded", function() {
                const customerMoneyField = document.getElementById("customer_money");
                const transactionDetailsBody = document.getElementById("transaction-details-body");

                customerMoneyField.addEventListener("input", updateChange);
                transactionDetailsBody.addEventListener("input", updateTotals);

                // Pass product details from backend to JavaScript
                const productDetails = @json($productDetails);
                const productSearch = document.getElementById("product_search");
                const productListBody = document.getElementById("product-list-body");

                productSearch.addEventListener("input", function() {
                    const searchValue = this.value.toLowerCase().trim();
                    productListBody.innerHTML = ""; // Clear product list

                    if (searchValue) {
                        const filteredProducts = productDetails.filter((productDetail) =>
                            productDetail.product.name.toLowerCase().includes(searchValue) ||
                            productDetail.product.code.toLowerCase().includes(searchValue)
                        );

                        filteredProducts.forEach((productDetail) => {
                            const row = document.createElement("tr");
                            row.innerHTML = `
                            <td>${productDetail.product.name}</td>
                            <td>${productDetail.size}</td>
                            <td>${productDetail.color}</td>
                            <td class="price" data-value="${productDetail.price}">${formatRupiah(productDetail.price)}</td>
                            <td>${productDetail.stock}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm add-product" 
                                    data-id="${productDetail.id}" ${productDetail.stock === 0 ? "disabled" : ""}>
                                    +
                                </button>
                            </td>
                        `;
                            productListBody.appendChild(row);
                        });

                        document.querySelectorAll(".add-product").forEach((button) => {
                            button.addEventListener("click", function() {
                                const id = this.getAttribute("data-id");
                                const productDetail = productDetails.find((p) => p.id == id);
                                addProductToTransactionDetails(productDetail);
                                productSearch.value = ""; // Clear search
                                productListBody.innerHTML = ""; // Clear product list
                            });
                        });
                    }
                });

                function addProductToTransactionDetails(productDetail) {
                    const transactionDetailsBody = document.getElementById("transaction-details-body");
                    const index = transactionDetailsBody.children.length;

                    const row = document.createElement("tr");
                    row.innerHTML = `
                    <td>${productDetail.product.name}</td>
                    <td>${productDetail.size}</td>
                    <td>${productDetail.color}</td>
                    <td class="price" data-value="${productDetail.price}">${formatRupiah(productDetail.price)}</td>
                    <td>${productDetail.stock}</td>
                    <td>
                        <input type="number" name="details[${index}][quantity]" class="form-control quantity" 
                            min="1" max="${productDetail.stock}" value="1" required>
                        <input type="hidden" name="details[${index}][product_detail_id]" value="${productDetail.id}">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-product">-</button>
                    </td>
                `;

                    transactionDetailsBody.appendChild(row);

                    row.querySelector(".remove-product").addEventListener("click", function() {
                        row.remove();
                        updateTotals();
                    });

                    row.querySelector(".quantity").addEventListener("input", updateTotals);
                    updateTotals();
                }
            });
        </script>
    @endsection
