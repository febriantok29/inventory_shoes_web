@extends('layouts.app')

@section('title', 'Product Purchase Report')

@section('content')
    <div class="container">
        <h1>Product Purchase Report</h1>

        <!-- Form untuk filter laporan berdasarkan tanggal -->
        <form method="GET" action="{{ route('product_purchase_report.index') }}" class="form-inline mb-4">
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
                        <h5 class="card-title">Total Cost</h5>
                        <p class="card-text">{{ number_format($totalCost, 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Quantity</h5>
                        <p class="card-text">{{ $totalQuantity }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Transactions</h5>
                        <p class="card-text">{{ $transactionCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Transaksi Pembelian Produk -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Purchase Date</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Purchase Price</th>
                    <th>Supplier Name</th>
                    <th>Total Cost</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->purchase_date }}</td>
                        <td>{{ $purchase->product_name }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>{{ number_format($purchase->purchase_price, 2) }}</td>
                        <td>{{ $purchase->supplier_name }}</td>
                        <td>{{ number_format($purchase->purchase_price * $purchase->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
