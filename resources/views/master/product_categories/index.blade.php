@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Kategori Produk</h1>
        <a href="{{ route('product_categories.create') }}" class="btn btn-primary mb-3">Tambah Kategori Baru</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>SKU</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->code }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('product_categories.show', $category) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('product_categories.edit', $category) }}"
                                class="btn btn-warning btn-sm">Perbarui</a>
                            <form action="{{ route('product_categories.destroy', $category) }}" method="POST"
                                style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
