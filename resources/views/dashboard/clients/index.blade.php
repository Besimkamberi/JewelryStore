@include('navigation-menu')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Clients | Jewelry-Store Admin</title>
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
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h1 class="admin-title mb-0"><i class="bi bi-people me-2"></i>Clients</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="glass p-4">
                    @if($clients && count($clients) > 0)
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Registered</th>
                                    <th scope="col" class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td class="fw-semibold">{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->created_at->format('Y-m-d') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.clients.show', $client->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="alert alert-warning text-center m-0">0 clients</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html> 