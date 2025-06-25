@include('navigation-menu')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop | Jewelry-Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(120deg, #f8fafc 0%, #f3e9d2 100%);
            font-family: 'Nunito', Arial, sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 8px 32px 0 rgba(191, 161, 74, 0.10), 0 1.5px 6px 0 rgba(0,0,0,0.08);
            border-radius: 1.5rem;
            border: 1px solid #bfa14a22;
            backdrop-filter: blur(4px);
        }
        .shop-title {
            color: #bfa14a;
            letter-spacing: 1px;
            font-weight: 800;
        }
        .product-card-hover {
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .product-card-hover:hover {
            box-shadow: 0 8px 32px 0 rgba(191, 161, 74, 0.15), 0 1.5px 6px 0 rgba(0,0,0,0.08);
            transform: translateY(-4px) scale(1.03);
            border-color: #bfa14a !important;
        }
        .object-fit-cover {
            object-fit: cover;
        }
        .btn-warning, .btn-outline-warning:hover {
            background: #bfa14a;
            color: #fff;
            border: none;
        }
        .btn-outline-warning {
            border-color: #bfa14a;
            color: #bfa14a;
        }
        .badge.bg-warning {
            background-color: #bfa14a !important;
            color: #fff !important;
        }
    </style>
</head>
<body>
    <!-- Hero Banner -->
    <section class="py-5 text-center bg-light border-bottom mb-4">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8">
                    <h1 class="shop-title display-5 fw-bold mb-2">Discover Exquisite Jewelry</h1>
                    <p class="lead text-secondary mb-3">Timeless elegance, modern design. Find your next treasure in our curated collection of rings, necklaces, bracelets, and more.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Search & Sort Bar -->
    <section class="pt-2 pb-4">
        <div class="container">
            <div class="row g-2 align-items-center justify-content-between">
                <div class="col-md-7 col-12 mb-2 mb-md-0">
                    <form action="{{ route('shop') }}" method="GET" class="input-group shadow-sm rounded">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="search" name="search" id="search" class="form-control border-start-0" placeholder="Search jewelry..." @if(Request::get('search')) value="{{ Request::get('search') }}" @endif />
                    </form>
                </div>
                <div class="col-md-4 col-12">
                    <form action="{{ route('shop') }}" method="GET">
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
    <!-- Products Grid -->
    <section class="products pb-5">
        <div class="container">
            <div class="glass p-4">
                <div class="row g-4">
                    @if($products && count($products) > 0)
                        @foreach($products as $product)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="card h-100 shadow-sm border-0 rounded-4 position-relative product-card-hover">
                                    <img src="{{ asset('storage/products/'.$product->image) }}" class="card-img-top rounded-top-4 object-fit-cover" style="height: 180px; background: #f8f9fa;" alt="{{ $product->name }}" />
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h5 class="card-title fw-semibold mb-1" style="color: #bfa14a;">{{ $product->name }}</h5>
                                        <span class="badge bg-warning text-dark mb-2" style="font-size: 1rem;">{{ number_format($product->price, 2) }} &euro;</span>
                                        <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST" class="mt-auto">
                                            @csrf
                                            <input type="hidden" name="qty" value="1">
                                            <button type="submit" class="btn btn-warning w-100 fw-bold">
                                                <i class="bi bi-cart-plus me-1"></i> Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="w-100 mb-2 mt-4">
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
                        <div class="col-12">
                            <div class="alert alert-warning text-center shadow-sm" role="alert">
                                <i class="bi bi-exclamation-circle me-2"></i> No products found.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('sort').addEventListener('change', (e) => {
            window.location.href = '?sort='+e.target.value
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>