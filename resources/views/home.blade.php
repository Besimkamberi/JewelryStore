@extends('layouts.front')
@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section position-relative overflow-hidden" style="background: linear-gradient(120deg, #fffbe6 0%, #bfa14a 100%); min-height: 380px;">
        <div class="gold-shimmer position-absolute top-0 start-0 w-100 h-100"></div>
        <div class="container position-relative z-2 d-flex flex-column justify-content-center align-items-center text-center" style="min-height: 380px;">
            <span class="d-inline-block mb-3" style="background: rgba(255,255,255,0.2); border-radius: 50%; padding: 1.2rem; box-shadow: 0 4px 24px #bfa14a33;">
                <i class="bi bi-gem" style="font-size: 3rem; color: #bfa14a;"></i>
            </span>
            <h1 class="display-3 fw-bold mb-3" style="color: #bfa14a; letter-spacing: 2px; text-shadow: 0 2px 8px rgba(191,161,74,0.08)">Jewelry Store</h1>
            <p class="lead text-dark mb-4" style="max-width: 600px; margin: 0 auto;">Discover timeless elegance with our exquisite collection of jewelry, designed to add a touch of luxury to every moment.</p>
            <a href="#products-section" class="btn btn-lg btn-warning shadow px-5 py-2 fw-bold" style="background: #bfa14a; border: none;">Shop Now</a>
        </div>
    </section>

    <!-- Search & Sort Bar -->
    <section class="pt-2 pb-4">
        <div class="container">
            <div class="row g-2 align-items-center justify-content-between">
                <div class="col-md-7 col-12 mb-2 mb-md-0">
                    <form action="{{ route('home') }}" method="GET" class="input-group shadow-sm rounded">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="search" name="search" id="search" class="form-control border-start-0" placeholder="Search jewelry..." @if(Request::get('search')) value="{{ Request::get('search') }}" @endif />
                    </form>
                </div>
                <div class="col-md-4 col-12">
                    <form action="{{ route('home') }}" method="GET">
                        <select name="sort" id="sort" class="form-select shadow-sm" required>
                            <option value="">Sort by</option>
                            <option value="name_asc" @if(Request::get('sort') === 'name_asc') selected @endif>Name A-Z</option>
                            <option value="name_desc" @if(Request::get('sort') === 'name_desc') selected @endif>Name Z-A</option>
                            <option value="price_asc" @if(Request::get('sort') === 'price_asc') selected @endif>Price Low-High</option>
                            <option value="price_desc" @if(Request::get('sort') === 'price_desc') selected @endif>Price High-Low</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Products Section -->
    <section id="products-section" class="latest-products py-5" style="background: linear-gradient(120deg, #fffbe6 0%, #f8fafc 100%);">
        <div class="container">
            <h2 class="mb-5 text-center fw-bold" style="letter-spacing: 1px; color: #bfa14a;">Latest Products</h2>
            <div class="row g-4">
                @if($products && count($products) > 0)
                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-stretch">
                        <div class="glass-card card border-0 shadow-sm h-100 product-card position-relative overflow-hidden" style="transition: box-shadow 0.2s, transform 0.2s;">
                            <div class="bg-white d-flex justify-content-center align-items-center rounded-top-4" style="height: 220px;">
                                <img src="{{ asset('storage/products/'.$product->image) }}" class="img-fluid" style="max-height: 180px; object-fit: contain;" alt="{{ $product->name }}" />
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-semibold mb-2" style="color: #bfa14a;">{{ $product->name }}</h5>
                                <p class="card-text mb-2">{{ $product->price }} &euro;</p>
                                <p class="text-muted small mb-3" style="min-height: 48px;">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('products.show', ['product' => $product->id]) }}" class="btn btn-outline-warning w-100"><i class="bi bi-eye"></i> View details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="w-100 mb-2">
                        <div class="d-flex justify-content-center">
                            <small class="text-center">
                                Showing {{ $products->count() }} of {{ $products->total() }} products |
                                Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
                            </small>
                        </div>
                    </div>
                    <nav aria-label="Product pagination">
                        <ul class="pagination justify-content-center shadow-sm p-2 bg-white rounded-3">
                            {{-- Previous Page Link --}}
                            @if ($products->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                            @endif
                            {{-- Pagination Elements --}}
                            @for ($page = 1; $page <= $products->lastPage(); $page++)
                                @if ($page == $products->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $products->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endfor
                            {{-- Next Page Link --}}
                            @if ($products->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                            @endif
                        </ul>
                    </nav>
                @else
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="alert alert-warning text-center" role="alert">
                            0 products
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <style>
        html {
            scroll-behavior: smooth;
        }
        .hero-section {
            position: relative;
            z-index: 1;
        }
        .hero-section .container {
            z-index: 2;
        }
        .gold-shimmer {
            pointer-events: none;
            background: linear-gradient(120deg, rgba(255,255,255,0.1) 0%, rgba(191,161,74,0.15) 100%);
            animation: shimmer 3s infinite linear alternate;
            opacity: 0.7;
        }
        @keyframes shimmer {
            0% { filter: brightness(1) blur(0px); }
            100% { filter: brightness(1.1) blur(1.5px); }
        }
        .glass-card {
            background: rgba(255,255,255,0.85);
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(191, 161, 74, 0.10), 0 1.5px 6px 0 rgba(0,0,0,0.08);
            border: 1px solid #bfa14a22;
            backdrop-filter: blur(4px);
        }
        .product-card:hover {
            box-shadow: 0 8px 32px 0 rgba(191, 161, 74, 0.18), 0 1.5px 4px 0 rgba(0,0,0,0.10);
            border: 1px solid #bfa14a44;
            transform: translateY(-4px) scale(1.03);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
    document.getElementById('sort').addEventListener('change', (e) => {
        window.location.href = '?sort='+e.target.value
    })
    </script>
@endsection
        