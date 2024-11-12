@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Ajuan Pembelian Sepatu</h1>

        @if ($errors->any() || session('error'))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                    @if (session('error'))
                        <li>{{ session('error') }}</li>
                    @endif
                </ul>
            </div>
        @endif

        <form action="{{ route('product_purchases.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="form-group">
                    <label for="purchase_date">Tanggal Pembelian</label>
                    <input type="date" name="purchase_date" id="purchase_date" class="form-control"
                        value="{{ old('purchase_date') ?? date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                </div>
                <div class="form-group row">
                    <div class="form-group col-md-6">
                        <label for="product_id">Sepatu</label>
                        <select name="product_id" id="product_id" class="form-control">
                            <option value="">Silakan pilih sepatu</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="supplier_id">Pemasok</label>
                        <select name="supplier_id" id="supplier_id" class="form-control">
                            <option value="">Silakan pilih pemasok</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->code }} - {{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-md-4">
                        <label for="quantity">Jumlah</label>
                        <input type="number" name="quantity" id="quantity" class="form-control"
                            value="{{ old('quantity') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="purchase_price">Harga Beli</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" name="purchase_price" id="purchase_price" class="form-control"
                                value="{{ old('purchase_price') }}">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="total_cost" class="d-block">Total</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" name="total_cost" id="total_cost" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Catatan</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>
            </div>

            {{-- Show back and save button --}}
            <div class="form-group mt-3">
                <a href="{{ route('product_purchases.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        function formatRupiah(value) {
            const numberString = value.replace(/[^,\d]/g, '').toString();
            const split = numberString.split(',');
            const sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                const separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        }

        function formatAndCalculate() {
            const purchasePriceInput = document.getElementById('purchase_price');
            const quantityInput = document.getElementById('quantity');
            const totalCostInput = document.getElementById('total_cost');

            // Format the purchase price to IDR Rupiah format
            purchasePriceInput.value = formatRupiah(purchasePriceInput.value);

            // Calculate total cost if both quantity and purchase price are available
            const quantity = parseInt(quantityInput.value.replace(/\./g, ''), 10) || 0;
            const purchasePrice = parseInt(purchasePriceInput.value.replace(/\./g, ''), 10) || 0;
            const totalCost = quantity * purchasePrice;
            totalCostInput.value = formatRupiah(totalCost.toString());
        }

        document.getElementById('purchase_price').addEventListener('keyup', formatAndCalculate);
        document.getElementById('quantity').addEventListener('keyup', formatAndCalculate);
    </script>
@endsection
