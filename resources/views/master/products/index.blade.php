@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pengelolaan Sepatu</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Sepatu Baru</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Sepatu</th>
                    <th>SKU
                    <th>Ukuran</th>
                    <th>Warna</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->size }}</td>
                        <td>{{ $product->color }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->supplier->name }}</td>
                        <td>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Perbarui</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus {{ $product->name }}?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
