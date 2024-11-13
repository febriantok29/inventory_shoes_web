@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Detail Retur Penjualan</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h5>Informasi Retur</h5>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Retur</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $productSalesReturn->code }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Transaksi Penjualan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $productSalesReturn->sales->invoice }}"
                            readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Retur</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $productSalesReturn->return_date }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Total Kuantitas</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $productSalesReturn->total_quantity }}"
                            readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Total Harga</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control"
                            value="Rp {{ number_format($productSalesReturn->total_price, 0, ',', '.') }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Catatan</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="3" readonly>{{ $productSalesReturn->note }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5>Detail Produk yang Diretur</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Kuantitas Retur</th>
                                <th>Total Harga</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productSalesReturn->details as $detail)
                                <tr>
                                    <td>{{ $detail->product->name }}</td>
                                    <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>Rp {{ number_format($detail->total, 0, ',', '.') }}</td>
                                    <td>{{ $detail->note }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('product_sales_returns.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar
                    Retur</a>
            </div>
        </div>
    </div>
@endsection
