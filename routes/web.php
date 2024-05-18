<?php

use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CategoryPage;
use App\Livewire\CheckoutPage;
use App\Livewire\ContactPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrdersDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\SuccessCartPage;
use App\Livewire\SuccessPage;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomePage::class);
Route::get('/categories', CategoryPage::class);
Route::get('/products', ProductsPage::class)->name('products');
Route::get('/cart', CartPage::class);
Route::get('/contact', ContactPage::class)->name('contact');
Route::get('/products/{slug}', ProductDetailPage::class);



Route::middleware('guest')->group(function () {
Route::get('/login', LoginPage::class)->name('login');
Route::get('/register', RegisterPage::class);
});


Route::middleware(('auth'))->group(function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect('/');
    });
Route::get('/checkout', CheckoutPage::class);
Route::get('/my-orders', MyOrdersPage::class);
Route::get('/success', SuccessPage::class)->name('success');

});