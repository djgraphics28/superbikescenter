<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\InquiryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// public routes
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/brands', [BrandController::class, 'index'])->name('brands');

//Inquiries
Route::post('/inquiries', [InquiryController::class, 'store'])->name('submit.inquiry');
