@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pemasok</h1>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">Tambah Pemasok Baru</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>
                            <a href="{{ route('suppliers.show', $supplier) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning btn-sm">Perbarui</a>
                            <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
