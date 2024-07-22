<?php

use App\Livewire\Customer\Register as CustomerRegister;
use App\Livewire\Home;
use App\Livewire\Post\Show as PostShow;
use App\Livewire\Product\Show as ProductShow;
use App\Livewire\Motorcycle\Index as MotorcyclShow;
use App\Livewire\About\Index as AboutPage;
use App\Livewire\Contact\Index as ContactPage;
use App\Livewire\Auth\Login as Login;
use App\Livewire\Auth\Register as Register;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/article/{post:slug}', PostShow::class)->name('post.show');
Route::get('/product/{product:slug}', ProductShow::class)->name('product.show');

Route::get('/motorcycles', MotorcyclShow::class)->name('motorcycles.index');
Route::get('/about', AboutPage::class)->name('about.index');
Route::get('/contact', ContactPage::class)->name('contact.index');

Route::get('/customer/register', CustomerRegister::class)->name('customer.register');


Route::get('login', Login::class)->name('login');
Route::get('register', Register::class)->name('register');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', function() {
        auth()->logout();
        return redirect()->route('home');
    })->name('logout');
});
