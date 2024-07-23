<?php

use App\Livewire\Auth\EmailVerify;
use App\Livewire\Home;
use Illuminate\Http\Request;
use App\Livewire\Auth\Login as Login;
use Illuminate\Support\Facades\Route;
use App\Livewire\Post\Show as PostShow;
use App\Livewire\About\Index as AboutPage;
use App\Livewire\Auth\Register as Register;
use App\Livewire\Product\Show as ProductShow;
use App\Livewire\Contact\Index as ContactPage;
use App\Livewire\Profile\Index as ProfileIndex;
use App\Livewire\Application\Index as ApplicationIndex;
use App\Livewire\Motorcycle\Index as MotorcyclShow;
use App\Livewire\Customer\Register as CustomerRegister;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', Home::class)->name('home');
Route::get('/article/{post:slug}', PostShow::class)->name('post.show');
Route::get('/product/{product:slug}', ProductShow::class)->name('product.show');

Route::get('/motorcycles', MotorcyclShow::class)->name('motorcycles.index');
Route::get('/about', AboutPage::class)->name('about.index');
Route::get('/contact', ContactPage::class)->name('contact.index');

Route::get('/customer/register', CustomerRegister::class)->name('customer.register');


Route::get('login', Login::class)->name('login');
Route::get('register', Register::class)->name('register');

Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('/logout', function() {
        auth()->logout();
        return redirect()->route('home');
    })->name('logout');

    Route::get('/profile', ProfileIndex::class)->name('profile');
    Route::get('/application', ApplicationIndex::class)->name('application');
});

Route::get('/email/verify', EmailVerify::class)->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('profile');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
