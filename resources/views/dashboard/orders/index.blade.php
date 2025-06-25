@php $isAdmin = Auth::user() && Auth::user()->hasRole('admin'); @endphp
@include('navigation-menu')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders | Jewelry-Store Admin</title>
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
        .table thead {
            background: #fffbe6;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-outline-danger {
            border-color: #bfa14a;
            color: #bfa14a;
        }
        .btn-outline-danger:hover {
            background: #bfa14a;
            color: #fff;
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
                <h1 class="admin-title mb-2"><i class="bi bi-bag-check me-2"></i>Orders</h1>
                <p class="lead text-secondary">Track and manage all orders placed in the store.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if(Session::has('status'))
                    <div class="alert alert-info">{{ Session::get('status') }}</div>
                @endif
                <div class="glass p-4">
                    @if($orders && count($orders) > 0)
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        <span class="fw-semibold">{{ $order->fullname }}</span><br />
                                        <span class="text-muted small">{{ $order->email }}</span><br />
                                        @if($order->phone)
                                            <span class="text-muted small">{{ $order->phone }}</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($order->total, 2, '.', '') }} &euro;</td>
                                    <td class="text-end">
                                        <form action="{{ $isAdmin ? route('admin.orders.destroy', ['order' => $order->id]) : route('client.orders.destroy', ['order' => $order->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="alert alert-warning text-center m-0">No orders found.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
