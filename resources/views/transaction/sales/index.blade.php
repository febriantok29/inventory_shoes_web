@extends('layouts.app')

@section('title', 'Daftar Penjualan')

@section('page_title', 'Daftar Penjualan')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Penjualan</h3>
                    <div class="card-tools">
                        <a href="{{ route('sales.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Penjualan
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sepatu</th>
                                <th>Jumlah Sepatu</th>
                                <th>Total Harga</th>
                                <th>Harga Dibayar</th>
                                <th>Uang Kembalian</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($salesTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ count($transaction->details) }} sepatu</td>
                                    <td>{{ $transaction->total_items }}</td>
                                    <td>{{ $transaction->formatted_total_price }}</td>
                                    <td>{{ $transaction->formatted_customer_money }}</td>
                                    <td>{{ $transaction->formatted_change }}</td>
                                    <td>{{ $transaction->formatted_created_at }}</td>
                                    <td>
                                        <a href="{{ route('sales.show', $transaction->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
