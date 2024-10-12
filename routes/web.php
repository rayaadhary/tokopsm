<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;


Route::get('login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('dashboard', fn () => view('admin.dashboard'))->name('dashboard');

    Route::get('user', [UserController::class, 'index'])->name('admin.user');
    Route::get('user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('user', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('user/{user}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('user/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    Route::get('category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('category/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    Route::get('product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('product/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('product', [ProductController::class, 'store'])->name('admin.product.store');
    Route::post('product/{product}/upload-images', [ProductController::class, 'uploadImages'])->name('admin.product.uploadImages');
    Route::get('product/{product}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('product/{product}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
});

Route::get('/', [CustomerController::class, 'index'])->name('customer.home');
Route::get('/shop', [CustomerController::class, 'shop'])->name('customer.shop');
Route::get('/shop/{product}', [CustomerController::class, 'shopDetail'])->name('customer.shop.detail');

Route::get('/contact', fn () => view('customer.contact'))->name('customer.contact');
