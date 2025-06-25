@include('navigation-menu')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product | Jewelry-Store Admin</title>
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
        .admin-title {
            color: #bfa14a;
            letter-spacing: 1px;
            font-weight: 800;
        }
        .btn-warning {
            background: #bfa14a;
            border: none;
        }
        .btn-warning:hover {
            background: #a88d36;
        }
        .form-label {
            color: #bfa14a;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="glass p-4">
                    <div class="mb-4">
                        <h2 class="admin-title mb-0"><i class="bi bi-plus-circle me-2"></i>Create Product</h2>
                    </div>
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Product Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter product name" required>
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="form-label fw-semibold">Quantity</label>
                            <input type="number" id="qty" name="qty" class="form-control" placeholder="Enter product quantity" required min="0">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label fw-semibold">Price (&euro;)</label>
                            <input type="number" step="0.01" id="price" name="price" class="form-control" placeholder="Enter product price" required min="0">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter product description" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">Image</label>
                            <input type="file" id="image" name="image" class="form-control">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning fw-bold py-2"><i class="bi bi-check-circle me-1"></i>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
