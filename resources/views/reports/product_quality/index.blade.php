@extends('layouts.app')

@section('title', 'Product Quality Report')

@section('content')
    <div class="container">
        <h1>Product Quality Report</h1>

        <!-- Form untuk filter laporan berdasarkan tanggal -->
        <form method="GET" action="{{ route('product_quality_report.index') }}" class="form-inline mb-4">
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

        <!-- Tabel Laporan Kualitas Produk -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Issue Description</th>
                    <th>Quality Status</th>
                    <th>Reported Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($qualityReports as $report)
                    <tr>
                        <td>{{ $report->product_name }}</td>
                        <td>{{ $report->issue_description }}</td>
                        <td>{{ ucfirst($report->quality_status) }}</td>
                        <td>{{ $report->reported_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
