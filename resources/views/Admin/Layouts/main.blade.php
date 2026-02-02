<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Dashboard Admin')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="{{ asset('Admin/img/favicon.ico') }}" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries -->
    <link href="{{ asset('Admin/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Bootstrap -->
    <link href="{{ asset('Admin/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Dashmin Style -->
    <link href="{{ asset('Admin/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-light d-flex p-0">

        <!-- Spinner -->
        <div id="spinner"
            class="show bg-light position-fixed translate-middle w-100 vh-100 top-50 start-50
        d-flex align-items-center justify-content-center">
            <div class="spinner-border text-danger"></div>
        </div>

        @include('Admin.Partials.sidebar')

        <!-- Content -->
        <div class="content">

            <!-- Navbar -->
            <nav class="navbar navbar-expand navbar-dark sticky-top px-4 py-0"
                style="background: linear-gradient(90deg,#ff512f,#dd2476);">
                <a href="#" class="sidebar-toggler flex-shrink-0 text-danger">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle  d-flex align-items-center text-danger"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-2" style="font-size: 1.5rem;"></i>

                            <span class="d-none d-lg-inline-flex text-white">Admin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-3 shadow-sm m-0">
                            <form action="{{ url('/logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="container-fluid pt-4 px-4">
                @yield('container')
            </div>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            </br>
                            Distributed By <a class="border-bottom" href="https://themewagon.com"
                                target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('Admin/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('Admin/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('Admin/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('Admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script src="{{ asset('Admin/js/main.js') }}"></script>
    <script src="{{ asset('Admin/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('Admin/js/chart.js') }}"></script>
</body>

</html>
