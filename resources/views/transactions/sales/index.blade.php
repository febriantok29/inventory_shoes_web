@extends('layouts.app')

@section('title', 'Daftar Penjualan')

@section('content')
    <div class="container">
        <h1>Daftar Penjualan</h1>
        <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">Tambah Penjualan</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
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
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sale->customer_name }}</td>
                        <td>{{ $sale->total_amount }}</td>
                        <td>{{ number_format($sale->total_price, 2) }}</td>
                        <td>{{ $sale->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus penjualan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $sales->links() }}
    </div>
@endsection
