<?php

use App\Livewire\Customer\Register as CustomerRegister;
use App\Livewire\Home;
use App\Livewire\Post\Show as PostShow;
use App\Livewire\Product\Show as ProductShow;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/article/{post:slug}', PostShow::class)->name('post.show');
Route::get('/product/{product:slug}', ProductShow::class)->name('product.show');

Route::get('/customer/register', CustomerRegister::class)->name('customer.register');
