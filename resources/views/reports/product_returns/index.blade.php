@extends('layouts.app')

@section('title', 'Product Return Report')

@section('content')
    <div class="container">
        <h1>Product Return Report</h1>

        <!-- Form untuk filter laporan berdasarkan tanggal -->
        <form method="GET" action="{{ route('product_return_report.index') }}" class="form-inline mb-4">
            <div class="form-group mr-2">
                <label for="start_date" class="mr-1">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="form-group mr-2">
                <label for="end_date" class="mr-1">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <!-- Ringkasan Laporan -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Returns</h5>
                        <p class="card-text">{{ $totalReturns }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Quantity Returned</h5>
                        <p class="card-text">{{ $totalQuantityReturned }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Transaksi Retur Produk -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Return Date</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Customer Name</th>
                    <th>Return Reason</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($returns as $return)
                    <tr>
                        <td>{{ $return->return_date }}</td>
                        <td>{{ $return->product_name }}</td>
                        <td>{{ $return->quantity }}</td>
                        <td>{{ $return->customer_name }}</td>
                        <td>{{ $return->return_reason }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
