@include('navigation-menu')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard | Jewelry-Store</title>
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
        .client-title {
            color: #bfa14a;
            letter-spacing: 1px;
            font-weight: 800;
        }
        .btn-outline-warning {
            border-color: #bfa14a;
            color: #bfa14a;
        }
        .btn-outline-warning:hover {
            background: #bfa14a;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="client-title mb-2">Welcome to Your Dashboard</h1>
                <p class="lead text-secondary">Easily manage your cart and orders below.</p>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            <!-- Cart Section -->
            <div class="col-md-6">
                <div class="glass h-100 p-4 text-center">
                    <i class="bi bi-cart4 display-4 mb-3" style="color: #bfa14a;"></i>
                    <h5 class="fw-bold mb-2">Your Cart</h5>
                    <p class="text-muted mb-3">View and manage the items you wish to purchase.</p>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-warning w-100"><i class="bi bi-cart"></i> Manage Cart</a>
                </div>
            </div>
            <!-- Orders Section -->
            <div class="col-md-6">
                <div class="glass h-100 p-4 text-center">
                    <i class="bi bi-bag-check display-4 mb-3" style="color: #bfa14a;"></i>
                    <h5 class="fw-bold mb-2">Your Orders</h5>
                    <p class="text-muted mb-3">Track your order history and view details of your purchases.</p>
                    <a href="{{ route('client.orders.index') }}" class="btn btn-outline-warning w-100"><i class="bi bi-bag"></i> View Orders</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html> 