@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Retur Penjualan - {{ $sale->invoice }}</h1>

        @if ($errors->any() || session('error'))
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    @if (session('error'))
                        <li>{{ session('error') }}</li>
                    @endif
                </ul>
            </div>
        @endif

        <form action="{{ route('product_sales_returns.store') }}" method="POST">
            @csrf
            <input type="hidden" name="sale_id" value="{{ $sale->id }}">
            <input type="hidden" name="return_price" id="return_price">
            <input type="hidden" name="total_quantity" id="total_quantity">

            <div class="card mb-3">
                <div class="card-header">Informasi Transaksi</div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="customer_name">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name"
                                value="{{ $sale->customer_name }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="return_date">Tanggal Retur</label>
                            <input type="date" class="form-control" id="return_date" name="return_date"
                                value="{{ old('return_date') ?? date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="total_quantity_display">Total Produk Retur</label>
                            <input type="text" class="form-control" id="total_quantity_display" value="0" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="total_price_display">Total Harga Retur</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control" id="total_price_display" value="0" readonly>
                            </div>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for="description">Catatan</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Catatan (opsional)">{{ old('description') }}</textarea>
                    </div>

                    <!-- Detail Produk Table -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered" id="salesTable">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Produk</th>
                                    <th>Ukuran</th>
                                    <th>Warna</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Retur</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sale->details as $detail)
                                    <tr>
                                        <td>{{ $detail->product->code }}</td>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ $detail->product->size }}</td>
                                        <td>{{ $detail->product->color }}</td>
                                        <td>Rp {{ number_format($detail->price) }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>
                                            <input type="number" class="form-control return-quantity"
                                                name="details[{{ $loop->index }}][return_quantity]"
                                                data-price="{{ $detail->price }}" min="0"
                                                max="{{ $detail->quantity }}" required>

                                            <input type="hidden" name="details[{{ $loop->index }}][product_id]"
                                                value="{{ $detail->product_id }}">
                                            <input type="hidden" name="details[{{ $loop->index }}][price]"
                                                value="{{ $detail->price }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control"
                                                name="details[{{ $loop->index }}][note]" placeholder="Catatan (opsional)">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript untuk hitung Total Produk dan Total Harga Retur -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const returnQuantityInputs = document.querySelectorAll('.return-quantity');
            const totalPriceInput = document.getElementById('return_price');
            const totalQuantityInput = document.getElementById('total_quantity');
            const totalPriceDisplay = document.getElementById('total_price_display');
            const totalQuantityDisplay = document.getElementById('total_quantity_display');

            function calculateTotals() {
                let totalReturnPrice = 0;
                let totalReturnQuantity = 0;

                returnQuantityInputs.forEach(input => {
                    const quantity = parseInt(input.value) || 0;
                    const price = parseFloat(input.getAttribute('data-price')) || 0;
                    totalReturnQuantity += quantity;
                    totalReturnPrice += quantity * price;
                });

                // Update hidden inputs for server processing
                totalPriceInput.value = totalReturnPrice;
                totalQuantityInput.value = totalReturnQuantity;

                // Update display fields with formatted values
                totalPriceDisplay.value = totalReturnPrice.toLocaleString('id-ID');
                totalQuantityDisplay.value = totalReturnQuantity;
            }

            returnQuantityInputs.forEach(input => {
                input.addEventListener('input', calculateTotals);
            });

            calculateTotals();
        });
    </script>
@endsection
