@extends('layouts.front')
@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <section class="product-details py-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary shadow-sm"><i class="bi bi-arrow-left"></i> Back to Home</a>
                </div>
            </div>
            <div class="row justify-content-center">
                @if($product)
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                            <div class="bg-white d-flex justify-content-center align-items-center" style="height: 350px;">
                                <img src="{{ asset('storage/products/'.$product->image) }}" class="img-fluid" style="max-height: 320px; object-fit: contain;" alt="{{ $product->name }}" />
                            </div>
                            <div class="card-body p-4">
                                <h2 class="card-title fw-bold mb-2" style="color: #bfa14a;">{{ $product->name }}</h2>
                                <h4 class="mb-3" style="color: #333;">{{ $product->price }} &euro;</h4>
                                <p class="text-muted mb-3">{{ $product->description }}</p>
                                <div class="mb-3">
                                    <span class="badge bg-success">In stock: {{ $product->qty }}</span>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if( Session::has('status') )
                                    <div class="alert alert-info">{{ Session::get('status') }}</div>
                                @endif
                                @if($product->qty > 0)
                                    <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST" class="row g-2 align-items-end mt-4">
                                        @csrf
                                        <div class="col-auto">
                                            <label for="qty" class="form-label mb-0">Quantity</label>
                                            <input type="number" name="qty" id="qty" class="form-control" value="1" min="1" max="{{ $product->qty }}" style="width: 90px;" />
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-warning px-4"><i class="bi bi-cart-plus"></i> Add to cart</button>
                                        </div>
                                    </form>
                                @else
                                    <p class="text-danger mt-4">{{ $product->name }} is out of stock!</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <style>
        .product-details .card {
            border-radius: 1.5rem;
        }
        .product-details .card-title {
            letter-spacing: 1px;
        }
        .product-details .btn-warning {
            background: linear-gradient(90deg, #bfa14a 0%, #f7e7b0 100%);
            color: #333;
            border: none;
        }
        .product-details .btn-warning:hover {
            background: linear-gradient(90deg, #f7e7b0 0%, #bfa14a 100%);
            color: #222;
        }
    </style>
@endsection
    
