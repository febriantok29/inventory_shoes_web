@extends('layouts.app')

@section('title', 'Dashboard')

@section('page_title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Selamat Datang di Dashboard</h3>
                </div>
                <div class="card-body">
                    <p>Ini adalah halaman dashboard utama. Anda dapat menambahkan informasi dan statistik di sini.</p>
                    <p>Silakan gunakan menu di sebelah kiri untuk navigasi ke bagian lain dari aplikasi.</p>
                    <div>
                        <h2>Statistics</h2>
                        <p>Total Products: {{ $totalProducts }}</p>
                        <p>Total Sales: {{ $totalSales }}</p>
                        <p>Total Damaged Products: {{ $totalDamagedProducts }}</p>
                    </div>
                    <div>
                        <h2>Weekly Sales</h2>
                        <canvas id="weeklySalesChart"></canvas>
                    </div>
                    <div>
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
                    borderWidth: 1
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
