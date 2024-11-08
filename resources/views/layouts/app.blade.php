<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Inventory Shoes')</title>

    <!-- Bootstrap CSS dan AdminLTE CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Tombol untuk toggle sidebar -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Title Navbar Tengah -->
            <span class="navbar-brand mx-auto font-weight-bold">Inventory Shoes Management</span>

            <!-- Logout link di navbar kanan -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
                <i class="fas fa-shoe-prints brand-icon"></i>
                <span class="brand-text font-weight-light">Inventory Shoes</span>
            </a>

            <div class="sidebar">
                <!-- Sidebar User Panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://via.placeholder.com/160" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name ?? 'Guest' }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Master Section -->
                        <li class="nav-header">MASTER</li>
                        <li class="nav-item">
                            <a href="{{ route('product_categories.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>Kategori Produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('suppliers.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-truck"></i>
                                <p>Suppliers</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('employees.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Employees</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-shoe-prints"></i>
                                <p>Produk Sepatu</p>
                            </a>
                        </li>

                        <!-- Transaction Section -->
                        <li class="nav-header">TRANSAKSI</li>
                        <li class="nav-item">
                            <a href="{{ route('sales.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>Penjualan Sepatu</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('damaged_products.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-exclamation-circle"></i>
                                <p>Damaged Products</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('product_stock_transactions.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-box"></i>
                                <>Kelola Stok Sepatu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product_purchases.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-shopping-bag"></i>
                                <p>Re-Stock Sepatu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product_sales_returns.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-undo"></i>
                                <p>Retur Penjualan</p>
                            </a>
                        </li>

                        <!-- Report Section -->
                        <li class="nav-header">LAPORAN</li>
                        <li class="nav-item">
                            <a href="{{ route('reports.sales_report') }}" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Sales Report</p>
                            </a>
                        </li>
                        {{--  <li class="nav-item">
                            <a href="{{ route('product_quality_report.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-check-circle"></i>
                                <p>Product Quality Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product_sales_report.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-file-invoice"></i>
                                <p>Product Sales Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product_purchase_report.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Product Purchase Report</p>
                            </a>
                        </li> --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </aside>
        <!-- /.sidebar -->

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content pt-3">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer text-center">
            <strong>&copy; {{ date('Y') }} Inventory Shoes.</strong> All rights reserved.
        </footer>
        <!-- /.footer -->

    </div>
    <!-- ./wrapper -->

    <!-- jQuery, Bootstrap, dan AdminLTE JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

</body>

</html>
