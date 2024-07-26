<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\InquiryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ApplicationController;
use App\Http\Controllers\API\EmailVerificationController;

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
Route::get('/barangays/{cityId}', [AddressController::class, 'getBarangays']);

//Inquiries
Route::post('/inquiries', [InquiryController::class, 'store'])->name('submit.inquiry');

//Applications
Route::post('/application', [ApplicationController::class, 'store'])->name('application.store');
Route::get('/application/{id}', [ApplicationController::class, 'getApplication'])->name('get-application');

//Profile
Route::get('/profile', [ProfileController::class, 'show']);
Route::post('/change-password', [ProfileController::class, 'changePassword']);

Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
    ->middleware('auth:sanctum')
    ->name('api.verification.notice');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth:sanctum', 'signed'])
    ->name('api.verification.verify');

Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
    ->middleware(['auth:sanctum', 'throttle:6,1'])
    ->name('api.verification.send');
