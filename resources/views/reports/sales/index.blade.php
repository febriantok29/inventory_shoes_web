@extends('layouts.app')

@section('title', 'Sales Report')

@section('content')
    <div class="container">
        <h1>Sales Report</h1>

        <!-- Form untuk filter laporan berdasarkan tanggal -->
        <form method="GET" action="{{ route('reports.sales_report') }}" class="form-inline mb-4">
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
                        <h5 class="card-title">Total Sales</h5>
                        <p class="card-text">{{ number_format($totalSales, 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Average Sales</h5>
                        <p class="card-text">{{ number_format($averageSales, 2) }}</p>
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

        <!-- Tabel Transaksi Penjualan -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ date('l, d F Y H:i', strtotime($sale->transaction_date)) }}</td>
                        <td>{{ $sale->customer_name }}</td>
                        <td>{{ number_format($sale->total_amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
