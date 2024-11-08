@extends('layouts.app')

@section('title', 'Dashboard - Inventory Shoes Management')

@section('content')
    <div class="dashboard-page">

        <!-- Header Section -->
        <section class="header-section py-4">
            <div class="container-fluid">
                <h1 class="display-5">Dashboard</h1>
                <p class="lead">Welcome back, {{ Auth::user()->name }}! Here is a quick overview of your inventory and
                    sales performance.</p>
            </div>
        </section>

        <!-- Statistics Cards -->
        <section class="statistics-section py-4">
            <div class="container-fluid">
                <div class="row">
                    <!-- Card 1: Total Products -->
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-primary h-100">
                            <div class="card-body">
                                <h5 class="card-title">Total Products</h5>
                                <p class="card-text display-4">{{ $totalProducts ?? '0' }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2: Total Sales -->
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-success h-100">
                            <div class="card-body">
                                <h5 class="card-title">Total Sales</h5>
                                <p class="card-text display-4">{{ $totalSales ?? '0' }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3: Stock Level -->
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-warning h-100">
                            <div class="card-body">
                                <h5 class="card-title">Stock Level</h5>
                                <p class="card-text display-4">{{ $stockLevel ?? '0' }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4: Damaged Products -->
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-danger h-100">
                            <div class="card-body">
                                <h5 class="card-title">Damaged Products</h5>
                                <p class="card-text display-4">{{ $damagedProducts ?? '0' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Charts Section -->
        <section class="charts-section py-4">
            <div class="container-fluid">
                <div class="row">
                    <!-- Sales Chart -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title">Sales Overview</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Stock Level Chart -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title">Stock Levels</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="stockChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Links Section -->
        <section class="quick-links-section py-4">
            <div class="container-fluid">
                <h3 class="mb-4">Quick Access</h3>
                <div class="row">
                    <!-- Link to Product Management -->
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg btn-block">Manage Products</a>
                    </div>
                    <!-- Link to Sales Transactions -->
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('sales.index') }}" class="btn btn-success btn-lg btn-block">View Sales</a>
                    </div>
                    <!-- Link to Stock Transactions -->
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('product_stock_transactions.index') }}"
                            class="btn btn-warning btn-lg btn-block">Stock Transactions</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($salesLabels) !!},
                datasets: [{
                    label: 'Sales',
                    data: {!! json_encode($salesData) !!},
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true
                    },
                    y: {
                        display: true
                    }
                }
            }
        });

        // Stock Chart
        const stockCtx = document.getElementById('stockChart').getContext('2d');
        const stockChart = new Chart(stockCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($stockLabels) !!},
                datasets: [{
                    label: 'Stock Level',
                    data: {!! json_encode($stockData) !!},
                    backgroundColor: 'rgba(255, 193, 7, 0.8)',
                    borderColor: 'rgba(255, 193, 7, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true
                    },
                    y: {
                        display: true
                    }
                }
            }
        });
    </script>

    <!-- Custom Styles -->
    <style>
        .header-section h1 {
            font-weight: 700;
        }

        .statistics-section .card {
            border-radius: 8px;
        }

        .charts-section .card,
        .quick-links-section .btn {
            border-radius: 8px;
        }

        .btn-block {
            display: block;
            width: 100%;
            font-size: 1.2rem;
        }
    </style>
@endsection
