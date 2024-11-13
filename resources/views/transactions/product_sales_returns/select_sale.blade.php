@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Pilih Transaksi Penjualan untuk Retur</h1>
        <form action="{{ route('product_sales_returns.select_sale') }}" method="GET" class="form-inline mb-3">
            <input type="text" name="invoice" class="form-control mr-2" placeholder="Cari berdasarkan Invoice">
            <input type="date" name="start_date" class="form-control mr-2" placeholder="Tanggal Mulai"
                value="{{ request('start_date') ?? date('Y-m-d', strtotime('-7 days')) }}" max="{{ date('Y-m-d') }}">
            <input type="date" name="end_date" class="form-control mr-2" placeholder="Tanggal Selesai"
                value="{{ request('end_date') ?? date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Total Sepatu</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->invoice }}</td>
                        <td>{{ $sale->details->count() }}</td>
                        <td>{{ $sale->transaction_date }}</td>
                        <td>Rp {{ number_format($sale->total_price) }}</td>
                        <td>
                            <a href="{{ route('product_sales_returns.show_sale_details', $sale) }}"
                                class="btn btn-sm btn-primary">Pilih</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
