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
                        <td>{{ $transaction->product->name }}</td>
                        <td>{{ $transaction->created_at->format('l, d F Y') }}</td>
                        @if ($transaction->type == 'IN')
                            <td class="text-success">
                                <i class="fas fa-arrow-down"></i> {{ $transaction->type }}
                            </td>
                        @else
                            <td class="text-danger">
                                <i class="fas fa-arrow-up"></i> {{ $transaction->type }}
                            </td>
                        @endif
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
