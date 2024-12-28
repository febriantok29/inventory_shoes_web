<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Master Section -->
                <li class="nav-header">MASTER</li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Kategori Sepatu</p>
                    </a>
                </li>
                <!-- Tambahkan menu master lainnya di sini -->

                <!-- Transaksi Section -->
                <li class="nav-header">TRANSAKSI</li>
                {{-- <li class="nav-item">
                    <a href="{{ route('asset_purchases.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Pembelian Asset</p>
                    </a>
                </li> --}}
                <!-- Tambahkan menu transaksi lainnya di sini -->
            </ul>
        </nav>
    </div>
</aside>
