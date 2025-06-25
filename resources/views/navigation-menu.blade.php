{{-- Modern Bootstrap 5 Navigation Bar for Jewelry Store --}}
<nav class="navbar navbar-expand-lg bg-white shadow-sm rounded-bottom" style="border-radius: 0 0 1.5rem 1.5rem;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <span class="me-2 d-flex align-items-center justify-content-center" style="background: rgba(255,255,255,0.2); border-radius: 50%; padding: 0.35rem 0.55rem; box-shadow: 0 2px 8px #bfa14a22;">
                <i class="bi bi-gem" style="font-size: 1.7rem; color: #bfa14a;"></i>
            </span>
            <span class="fw-bold fs-3" style="color: #bfa14a; letter-spacing: 1px; font-family: 'Playfair Display', serif;">Jewelry Store</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                @if(Auth::check())
                    {{-- Role-based links for logged-in users --}}
                    @role('admin')
                        <li class="nav-item"><a class="nav-link{{ request()->routeIs('admin.dashboard') ? ' active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link{{ request()->routeIs('products.*') ? ' active' : '' }}" href="{{ route('products.index') }}">Products</a></li>
                        <li class="nav-item"><a class="nav-link{{ request()->routeIs('admin.orders.*') ? ' active' : '' }}" href="{{ route('admin.orders.index') }}">Orders</a></li>
                    @elserole('client')
                        <li class="nav-item"><a class="nav-link{{ request()->routeIs('client.dashboard') ? ' active' : '' }}" href="{{ route('client.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link{{ request()->routeIs('client.orders.*') ? ' active' : '' }}" href="{{ route('client.orders.index') }}">Orders</a></li>
                    @endrole
                    {{-- User dropdown --}}
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (isset(Auth::user()->profile_photo_url))
                                <img src="{{ Auth::user()->profile_photo_url }}" class="rounded-circle me-2" width="32" height="32" alt="{{ Auth::user()->name }}">
                            @endif
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- Guest links --}}
                    <li class="nav-item"><a class="nav-link{{ request()->routeIs('home') ? ' active' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link{{ request()->routeIs('login') ? ' active' : '' }}" href="{{ route('login') }}">Log in</a></li>
                    @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link{{ request()->routeIs('register') ? ' active' : '' }}" href="{{ route('register') }}">Register</a></li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</nav>
<style>
    .navbar-nav .nav-link.active {
        color: #bfa14a !important;
        font-weight: bold;
        background: rgba(191, 161, 74, 0.08);
        border-radius: 0.5rem;
    }
    .navbar-nav .nav-link:hover {
        color: #bfa14a !important;
    }
    .navbar {
        box-shadow: 0 4px 24px 0 rgba(191, 161, 74, 0.08), 0 1.5px 4px 0 rgba(0,0,0,0.04);
    }
    .navbar-brand .fs-3 {
        font-family: 'Playfair Display', serif;
        font-size: 2rem !important;
    }
</style>
