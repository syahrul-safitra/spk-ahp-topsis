<div class="sidebar bg-white pe-4 pb-3">
    <nav class="navbar navbar-light">
        <a href="{{ url('/dashboard') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-danger fw-bold">
                <i class="bi bi-fire me-2"></i>AHP+TOPSIS
            </h3>
        </a>

        <div class="d-flex align-items-center ms-4 mb-4">
            {{-- <img class="rounded-circle" src="{{ asset('Admin/img/user.jpg') }}" style="width: 40px; height: 40px;"> --}}
            {{-- <i class="bi bi-person-circle" style="width: 40px; height: 40px;"></i> --}}
            <i class="bi bi-person-circle" style="font-size: 30px"></i>
            <div class="ms-3">
                <span class="fw-semibold">Administrator</span>
            </div>
        </div>

        <div class="navbar-nav w-100">
            <a href="{{ url('/dashboard') }}" class="nav-item nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>

            <a href="{{ url('/criteria') }}" class="nav-item nav-link {{ Request::is('product*') ? 'active' : '' }}">
                <i class="bi bi-cup-hot me-2"></i>Produk Seblak
            </a>

            <a href="{{ url('/comparison-matrix') }}"
                class="nav-item nav-link {{ Request::is('orders*') ? 'active' : '' }}">
                <i class="bi bi-cart-check me-2"></i>Order
            </a>

            <a href="{{ url('/ahp-test') }}" class="nav-item nav-link {{ Request::is('customer*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i>Customer
            </a>

            <a href="{{ url('/alternative') }}"
                class="nav-item nav-link {{ Request::is('laporan*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line me-2"></i>Laporan
            </a>

            <a href="{{ url('/ranking') }}" class="nav-item nav-link {{ Request::is('laporan*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line me-2"></i>Laporan
            </a>

            <hr>

            <a href="{{ url('/set-admin') }}" class="nav-item nav-link">
                <i class="bi bi-person-gear me-2"></i>Admin
            </a>
        </div>
    </nav>
</div>
