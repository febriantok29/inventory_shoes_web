@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Daftar Retur Penjualan</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('product_sales_returns.select_sale') }}" class="btn btn-primary mb-4">Buat Retur Penjualan</a>

        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Kode Retur</th>
                    <th>Transaksi Penjualan</th>
                    <th>Tanggal Retur</th>
                    <th>Total Barang</th>
                    <th>Total Harga</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productSalesReturns as $return)
                    <tr>
                        <td>{{ $return->code }}</td>
                        <td>{{ $return->sales->invoice }}</td>
                        <td>{{ $return->return_date }}</td>
                        <td>{{ $return->total_quantity }}</td>
                        <td>Rp {{ number_format($return->total_price, 0, ',', '.') }}</td>
                        <td>{{ $return->note }}</td>
                        <td>
                            <a href="{{ route('product_sales_returns.show', $return->id) }}"
                                class="btn btn-info btn-sm">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
