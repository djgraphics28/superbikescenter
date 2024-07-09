<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\InquiryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/customer/login', [AuthController::class, 'login']);
Route::post('/customer/register', [AuthController::class, 'register']);

// public routes
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('show.product');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/brands', [BrandController::class, 'index'])->name('brands');

Route::get('/provinces', [AddressController::class, 'getProvinces']);
Route::get('/cities/{provinceId}', [AddressController::class, 'getCities']);
Route::get('/brangays/{cityId}', [AddressController::class, 'getBarangays']);

//Inquiries
Route::post('/inquiries', [InquiryController::class, 'store'])->name('submit.inquiry');
