@extends('layouts.app')

@section('title', 'Detail Produk')

@section('page_title', 'Detail Produk')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Produk</h3>
                    <div class="card-tools">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit Produk</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Kode:</strong> {{ $product->code }}</p>
                            <p><strong>Nama:</strong> {{ $product->name }}</p>
                            <p><strong>Kategori:</strong> {{ $product->category->name }}</p>
                            <p><strong>Deskripsi:</strong> {{ $product->description }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Harga:</strong> {{ $product->formatted_price }}</p>
                            <p><strong>Total Stok:</strong> {{ $product->total_stock }}</p>
                        </div>
                    </div>
                    <h4>Detail Produk</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Ukuran</th>
                                <th>Warna</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->details as $detail)
                                <tr>
                                    <td>{{ $detail->size }}</td>
                                    <td>{{ $detail->color }}</td>
                                    <td>{{ $detail->stock }}</td>
                                    <td>{{ $detail->formatted_price }}</td>
                                    <td>{{ $detail->note }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
