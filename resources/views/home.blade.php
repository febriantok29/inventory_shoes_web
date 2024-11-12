<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Inventori Sepatu</title>

    <!-- Bootstrap CSS & AdminLTE -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        /* Hero Section */
        .hero {
            background-image: url('https://picsum.photos/seed/bar/1600/900');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            color: white;
            text-align: center;
            padding: 120px 0;
        }

        .hero-overlay {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 60px 0;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 15px;
            animation: fadeInDown 1.5s;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 30px;
            animation: fadeInUp 1.5s;
        }

        .hero .btn-main {
            font-size: 1.2rem;
            font-weight: bold;
            padding: 10px 30px;
            border-radius: 8px;
            animation: zoomIn 1.5s;
        }

        /* Keyframes for animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Features Section */
        .features {
            padding: 80px 0;
            background: #f9f9f9;
        }

        .feature-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: 0;
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .feature-card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .feature-card i {
            font-size: 3rem;
            color: #6c63ff;
            margin-bottom: 20px;
        }

        .feature-card h5 {
            font-size: 1.3rem;
            margin-top: 10px;
        }

        /* Parallax Section */
        .parallax {
            background-image: url("https://picsum.photos/seed/gas/1600/900");
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
        }

        .parallax h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        /* Testimonials Section */
        .testimonials {
            padding: 80px 0;
            background: #fff;
        }

        .testimonial-card {
            background: #f7f7f7;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: scale(1.05);
        }

        .testimonial-card p {
            font-size: 1rem;
            color: #555;
            margin-top: 10px;
        }

        /* CTA Section */
        .cta {
            background: linear-gradient(45deg, #1e3c72, #2a5298);
            color: white;
            text-align: center;
            padding: 70px 0;
        }

        .cta h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .cta .btn-main {
            font-size: 1.2rem;
            padding: 12px 35px;
            border-radius: 8px;
        }

        /* Footer */
        footer {
            background: #333;
            color: #bbb;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <span class="brand-text font-weight-light">Inventory Sepatu</span>
                </a>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Daftar</a>
                        </li> --}}
                    @else
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Hero Section -->
        <div class="hero">
            <div class="hero-overlay">
                <div class="container">
                    <h1>Selamat Datang di Inventory Sepatu</h1>
                    <p>Kelola inventori Anda dengan mudah, pantau penjualan, dan pastikan kualitas produk tetap terjaga.
                    </p>
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary btn-main">Masuk Sekarang</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-success btn-main">Dashboard</a>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="features">
            <div class="container text-center">
                <h2 class="section-title">Fitur Unggulan</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="feature-card">
                            <i class="fas fa-th-list"></i>
                            <h5>Kategori Produk</h5>
                            <p>Organisasi produk yang mudah, cepat, dan efisien.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <i class="fas fa-shopping-cart"></i>
                            <h5>Pemantauan Penjualan</h5>
                            <p>Monitor dan analisis penjualan secara real-time.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <i class="fas fa-chart-line"></i>
                            <h5>Laporan Terperinci</h5>
                            <p>Dapatkan wawasan mendalam dengan laporan lengkap.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Parallax Section -->
        <div class="parallax">
            <h2>Jadikan Inventori Sepatu Anda Lebih Efisien</h2>
            <p>Pantau stok secara real-time, optimalkan pengelolaan produk, dan buat keputusan yang tepat.</p>
        </div>

        <!-- Testimonials Section -->
        <div class="testimonials">
            <div class="container">
                <h2 class="section-title text-center">Apa Kata Pengguna Kami?</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="testimonial-card">
                            <i class="fas fa-user-circle fa-3x text-primary"></i>
                            <p>"Inventory Sepatu membantu saya mengelola stok dengan sangat mudah!"</p>
                            <p><strong>- Andi, Pemilik Toko Sepatu</strong></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="testimonial-card">
                            <i class="fas fa-user-circle fa-3x text-primary"></i>
                            <p>"Laporan yang lengkap dan mudah dibaca membantu bisnis saya berkembang."</p>
                            <p><strong>- Sari, Manajer Operasional</strong></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="testimonial-card">
                            <i class="fas fa-user-circle fa-3x text-primary"></i>
                            <p>"Pemantauan penjualan yang real-time memudahkan keputusan cepat!"</p>
                            <p><strong>- Budi, Analis Data</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        {{-- <div class="cta">
            <h2>Mulai Sekarang dan Kelola Inventori Anda Lebih Mudah!</h2>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg btn-main">Daftar Sekarang</a>
        </div> --}}

        <!-- Footer -->
        <footer>
            <p>&copy; 2023 Inventory Sepatu. Semua hak cipta dilindungi.</p>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
</body>

</html>
