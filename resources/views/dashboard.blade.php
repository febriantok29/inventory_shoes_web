@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Selamat Datang di Dashboard</h3>
                </div>
                <div class="card-body">
                    <p>Ini adalah halaman dashboard utama. Anda dapat menambahkan informasi dan statistik di sini.</p>
                    <p>Silakan gunakan menu di sebelah kiri untuk navigasi ke bagian lain dari aplikasi.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box bg-info">
                                <span class="info-box-icon"><i class="fas fa-cube"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Products</span>
                                    <span class="info-box-number">{{ $totalProducts }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Sales</span>
                                    <span class="info-box-number">{{ $totalSales }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h2>Weekly Sales</h2>
                        <canvas id="weeklySalesChart"></canvas>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('dashboard.downloadReport') }}" class="btn btn-primary">Download Sales Report</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script>
        const ctx = document.getElementById('weeklySalesChart').getContext('2d');
        const weeklySalesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($weeklySales->pluck('date')),
                datasets: [{
                    label: 'Sales',
                    data: @json($weeklySales->pluck('total')),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
