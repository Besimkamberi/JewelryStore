<?php

use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrdersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $query = Product::query();

    // Search
    if (request('search')) {
        $search = request('search');
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
    }

    // Sorting
    switch (request('sort')) {
        case 'name_asc':
            $query->orderBy('name', 'asc');
            break;
        case 'name_desc':
            $query->orderBy('name', 'desc');
            break;
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        default:
            $query->orderBy('created_at', 'desc');
    }

    $products = $query->paginate(9)->withQueryString();
    return view('home', compact('products'));
})->name('home');

Route::get('/shop', function() {
    $query = \App\Models\Product::query();

    // Search
    if (request('search')) {
        $search = request('search');
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
    }

    // Sorting
    switch (request('sort')) {
        case 'name_asc':
            $query->orderBy('name', 'asc');
            break;
        case 'name_desc':
            $query->orderBy('name', 'desc');
            break;
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        default:
            $query->orderBy('created_at', 'desc');
    }

    $products = $query->paginate(12)->withQueryString();
    return view('shop', compact('products'));
})->name('shop');

Route::get('/cart', function() {
    return view('cart');
})->name('cart.index');

Route::get('/dashboard', function () {
    // If there is an intended URL, redirect there
    if (session()->has('url.intended')) {
        return redirect()->intended();
    }
    if (Auth::check()) {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->hasRole('client')) {
            return redirect()->route('client.dashboard');
        }
    }
    abort(403);
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');
    Route::resource('products', ProductsController::class);
    Route::resource('orders', OrdersController::class)->names('admin.orders');
    Route::resource('clients', App\Http\Controllers\Admin\ClientController::class)->names('admin.clients');
});

Route::middleware(['auth', 'role:client'])->prefix('client')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.client');
    })->name('client.dashboard');
    Route::resource('orders', OrdersController::class)->only(['index', 'show', 'destroy'])->names('client.orders');
});

// Cart routes for client
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/inc/{item}', [CartController::class, 'inc'])->name('cart.inc');
    Route::get('/cart/dec/{item}', [CartController::class, 'dec'])->name('cart.dec');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::middleware('auth')->get('/products/{product}', [ProductsController::class, 'show'])->name('products.show');

require __DIR__.'/auth.php';
