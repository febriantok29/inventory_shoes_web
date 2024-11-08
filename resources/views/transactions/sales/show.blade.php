@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')
    <div class="container">
        <h1>Detail Penjualan</h1>
        <div>
            <strong>Nama Pelanggan:</strong> {{ $sale->customer_name }}
        </div>
        <div>
            <strong>Jumlah Item:</strong> {{ $sale->total_amount }}
        </div>
        <div>
            <strong>Total Harga:</strong> {{ number_format($sale->total_price, 2) }}
        </div>
        <div>
            <strong>Tanggal Transaksi:</strong> {{ $sale->created_at->format('d M Y') }}
        </div>

        <h3>Rincian Produk</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->details as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->price, 2) }}</td>
                        <td>{{ number_format($detail->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
