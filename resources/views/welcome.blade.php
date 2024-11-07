<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Shoes</title>

    <!-- Bootstrap CSS (AdminLTE Dependency) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <!-- Custom CSS -->
    <style>
        .hero-section {
            background-image: url('https://source.unsplash.com/1600x900/?shoes');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            color: #fff;
            padding: 100px 0;
        }

        .overlay {
            background: rgba(0, 0, 0, 0.5);
            padding: 100px 0;
        }

        .feature-section {
            padding: 60px 0;
        }

        .feature-box {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .cta-section {
            background: #007bff;
            color: #fff;
            padding: 60px 0;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white shadow-sm">
            <div class="container">
                <a href="{{ route('home') }}" class="navbar-brand">
                    <span class="brand-text font-weight-light">Inventory Shoes</span>
                </a>

                <!-- Navbar Toggle for Mobile View -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Hero Section with Parallax Effect -->
        <div class="hero-section text-center d-flex align-items-center">
            <div class="overlay w-100">
                <div class="container">
                    <h1 class="display-4">Welcome to Inventory Shoes</h1>
                    <p class="lead">Your ultimate solution for efficient shoe inventory management.</p>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg mt-3">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-3">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg mt-3">Register</a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="feature-section text-center">
            <div class="container">
                <h2 class="mb-4">Why Choose Inventory Shoes?</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="feature-box">
                            <i class="fas fa-shoe-prints fa-3x mb-3"></i>
                            <h4>Comprehensive Inventory</h4>
                            <p>Manage and track every shoe in your inventory effortlessly.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-box">
                            <i class="fas fa-chart-line fa-3x mb-3"></i>
                            <h4>Insightful Analytics</h4>
                            <p>Analyze your sales data and make data-driven decisions.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-box">
                            <i class="fas fa-users fa-3x mb-3"></i>
                            <h4>User-Friendly Interface</h4>
                            <p>Easy-to-use interface designed for optimal user experience.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="cta-section text-center">
            <div class="container">
                <h2 class="mb-4">Ready to streamline your inventory management?</h2>
                <p class="lead">Get started now and transform the way you manage your inventory.</p>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">Go to Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Register Now</a>
                @endauth
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer text-center mt-5">
            <strong>&copy; 2023 Inventory Shoes.</strong> All rights reserved.
            <div class="mt-2">
                <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a> | <a href="#">Help
                    Center</a>
            </div>
        </footer>
        <!-- /.footer -->

    </div>
    <!-- ./wrapper -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>

</html>
