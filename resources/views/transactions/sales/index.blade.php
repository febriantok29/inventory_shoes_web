@extends('layouts.app')

@section('title', 'Daftar Penjualan')

@section('content')
    <div class="container">
        <h1>Daftar Penjualan</h1>
        <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">Tambah Penjualan</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Nama Pelanggan</th>
                    <th>Jumlah Item</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->invoice }}</td>
                        <td>{{ $sale->customer_name }}</td>
                        <td>{{ $sale->total_amount }}</td>
                        <td> Rp {{ number_format($sale->total_price) }}</td>
                        <td>{{ $sale->transaction_date == null || $sale->transaction_date == '' ? '-' : '' . date('l, d F Y', strtotime($sale->transaction_date)) }}
                        </td>
                        <td>
                            <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $sales->links() }}
    </div>
@endsection
