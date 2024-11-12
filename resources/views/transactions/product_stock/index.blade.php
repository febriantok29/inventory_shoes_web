@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Monitoring Stock</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Sepatu</th>
                    <th>Tanggal Transaksi</th>
                    <th>Tipe Transaksi</th>
                    <th>Kuantitas</th>
                    <th>Catatan</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stockTransactions as $transaction)
                    <tr>
                        <td>{{ $transaction->product_name }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>{{ ucfirst($transaction->transaction_type) }}</td>
                        <td>{{ $transaction->transaction_date }}</td>
                        <td>
                            <a href="{{ route('product_stock_transactions.show', $transaction) }}"
                                class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
