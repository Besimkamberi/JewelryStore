@include('navigation-menu')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | Jewelry-Store</title>
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
        .cart-title {
            color: #bfa14a;
            letter-spacing: 1px;
            font-weight: 800;
        }
        .btn-outline-warning {
            border-color: #bfa14a;
            color: #bfa14a;
        }
        .btn-outline-warning:hover, .btn-warning {
            background: #bfa14a;
            color: #fff;
            border: none;
        }
        .btn-outline-primary {
            border-color: #bfa14a;
            color: #bfa14a;
        }
        .btn-outline-primary:hover {
            background: #bfa14a;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="cart-title mb-2"><i class="bi bi-cart4 me-2"></i>Your Cart</h1>
                <p class="lead text-secondary">Review your selected items and proceed to checkout.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if(count(Cart::getContent()) > 0)
                @if( Session::has('cart_status') )
                    <div class="alert alert-danger">{{ Session::get('cart_status') }}</div>
                @endif
                <div class="glass mb-4 p-4">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center" width="180px">Quantity</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\Cart::getContent() as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->name }}</td>
                                    <td class="d-flex justify-content-center align-items-center gap-2">
                                        <a href="{{ route('cart.dec', ['item' => $item->id]) }}" class="btn btn-sm btn-outline-primary">-</a>
                                        <span class="mx-2">{{ $item->quantity }}</span>
                                        <a href="{{ route('cart.inc', ['item' => $item->id]) }}" class="btn btn-sm btn-outline-primary">+</a>
                                    </td>
                                    <td class="text-end">{{ number_format($item->quantity * $item->price, 2, '.', '') }} &euro;</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-end fw-bold">Total:</td>
                                    <td class="text-end fw-bold" style="color: #bfa14a;">{{ number_format(\Cart::getTotal(), 2, '.', '') }} &euro;</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- Checkout -->
                @auth
                <div class="glass mb-4 p-4">
                    <h4 class="cart-title mb-4"><i class="bi bi-credit-card-2-front me-2"></i>Checkout</h4>
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
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning fw-bold py-2"><i class="bi bi-check-circle me-1"></i>Submit Order</button>
                        </div>
                    </form>
                </div>
                @endauth
                @guest
                    <div class="alert alert-info mt-4">
                        Please <a href="{{ url('/login') }}">login</a> first to checkout.
                    </div>
                @endguest
                @else
                <div class="glass text-center py-5">
                    <i class="bi bi-cart-x display-4 mb-3 text-muted"></i>
                    <h4 class="fw-bold mb-2">Your cart is empty!</h4>
                    <p class="text-muted">Browse our shop and add items to your cart.</p>
                    <a href="{{ route('shop') }}" class="btn btn-outline-warning"><i class="bi bi-shop"></i> Go to Shop</a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
        