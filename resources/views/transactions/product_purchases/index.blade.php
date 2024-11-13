@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Re-Stock Sepatu</h1>
        <a href="{{ route('product_purchases.create') }}" class="btn btn-primary mb-3">Ajukan Re-Stock Sepatu</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Sepatu</th>
                    <th>Pemasok</th>
                    <th>Tanggal Pembelian</th>
                    <th>Harga Beli</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productPurchases as $purchase)
                    <tr>
                        <td> {{ $purchase->product->name }} </td>
                        <td> {{ $purchase->supplier->code }} - {{ $purchase->supplier->name }} </td>
                        <td> {{ $purchase->created_at->format('l, d F Y') }} </td>
                        {{-- Format `price` to IDR currency "Rp 1.000.000" --}}
                        <td> Rp {{ number_format($purchase->purchase_price, 0, ',', '.') }} </td>
                        <td> {{ $purchase->quantity }} </td>
                        <td> Rp {{ number_format($purchase->total_cost, 0, ',', '.') }} </td>
                        {{-- If `description` long than 20 characters, show only 20 characters and append "..." --}}
                        <td> {{ strlen($purchase->description) > 20 ? substr($purchase->description, 0, 20) . '...' : $purchase->description }}
                        </td>
                        <td>
                            <a href="{{ route('product_purchases.show', $purchase) }}" class="btn btn-info btn-sm">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
