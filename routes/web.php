<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function () {
    return view('public.landing');
})->name('home');

Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);
    });

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('products', ProductController::class)->names([
            'index' => 'products.index',
            'create' => 'products.create',
            'store' => 'products.store',
            'show' => 'products.show',
            'edit' => 'products.edit',
            'update' => 'products.update',
            'destroy' => 'products.destroy',
        ]);

        Route::post('/products/bulk-actions', [ProductController::class, 'bulkActions'])
            ->name('products.bulk-actions');

        Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');
        Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');

        Route::prefix('categories')->as('categories.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('index');
            Route::post('/', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('store');
            Route::put('/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('inventory')->as('inventory.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\InventoryController::class, 'index'])->name('index');
            Route::post('/adjust', [\App\Http\Controllers\Admin\InventoryController::class, 'adjust'])->name('adjust');
        });

        Route::prefix('suppliers')->as('suppliers.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\SupplierController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\Admin\SupplierController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\Admin\SupplierController::class, 'store'])->name('store');
            Route::get('/{supplier}/edit', [\App\Http\Controllers\Admin\SupplierController::class, 'edit'])->name('edit');
            Route::put('/{supplier}', [\App\Http\Controllers\Admin\SupplierController::class, 'update'])->name('update');
            Route::delete('/{supplier}', [\App\Http\Controllers\Admin\SupplierController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('reports')->as('reports.')->group(function () {
            Route::get('/stock', [\App\Http\Controllers\Admin\ReportController::class, 'stock'])->name('stock');
            Route::get('/transactions', [\App\Http\Controllers\Admin\ReportController::class, 'transactions'])->name('transactions');
            Route::post('/export', [\App\Http\Controllers\Admin\ReportController::class, 'export'])->name('export');
        });

        Route::prefix('profile')->as('profile.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('edit');
            Route::put('/', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('update');
            Route::put('/password', [\App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('password.update');
        });
    });
});