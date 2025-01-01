@extends('layouts.app')

@section('title', 'Daftar Sales')

@section('page_title', 'Daftar Sales')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Sales</h3>
                    <div class="card-tools">
                        <a href="{{ route('sales.create') }}" class="btn btn-primary">Tambah Sales</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total Harga</th>
                                <th>Harga Dibayar</th>
                                <th>Uang Kembalian</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($salesTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->customer_name }}</td>\
                                    {{-- Count product on details, with suffix " sepatu" --}}
                                    <td>{{ count($transaction->details) }} sepatu</td>
                                    <td>{{ $transaction->total_items }}</td>
                                    <td>{{ $transaction->formatted_total_price }}</td>
                                    <td>{{ $transaction->formatted_customer_money }}</td>
                                    <td>{{ $transaction->formatted_change }}</td>
                                    <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('sales.show', $transaction->id) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('sales.edit', $transaction->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('sales.destroy', $transaction->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No sales transactions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
