<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\User\AddressController as UserAddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;








Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/product/{slug}', [HomeController::class, 'show'])
    ->name('product.show');

Route::get('/migrate-fresh', function () {
    // Menjalankan migrate:fresh (drop semua tabel lalu migrasi ulang)
    // --force wajib digunakan jika aplikasi berada dalam mode production
    Artisan::call('migrate:fresh', [
        '--force' => true,
        '--seed' => true // Opsional: Tambahkan ini jika ingin menjalankan seeder sekaligus
    ]);
    
    return "Database telah di-reset (fresh) dan di-seed!";
});

Route::get('/optimize', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Optimized!";
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return "Storage link created!";
});

Route::middleware('auth')->group(function () {
    // Tambahkan route ini untuk menangani tombol "Tambah ke Keranjang"
    Route::post('/cart/add', [CheckoutController::class, 'addToCart'])->name('cart.add');


    Route::get('/cart', [CheckoutController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CheckoutController::class, 'updateQty'])->name('cart.update');
    Route::delete('/cart/{variantId}', [CheckoutController::class, 'remove'])->name('cart.remove');


    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});


// Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


        Route::get('/dashboard', fn() => view('admin.dashboard'))
            ->name('dashboard');


        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
Route::resource('addresses', AddressController::class);
    });




// User
Route::middleware(['auth', 'role:user'])
    ->prefix('user') // Agar URL menjadi /user/addresses
    ->name('user.')   // Agar nama route menjadi user.addresses.index
    ->group(function () {
        
        Route::get('/dashboard', fn() => view('user.dashboard'))->name('dashboard');
        Route::resource('addresses', UserAddressController::class);
        
    });



