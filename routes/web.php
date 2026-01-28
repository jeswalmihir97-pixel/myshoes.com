<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StockController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('Layout\amaster');
});*/

//client sode route
Route::get('/register',[registerController ::class,'showregister'])->name('register');
Route::post('/register', [registerController::class, 'register'])->name('register.user');
Route::get('/login', [registerController::class, 'showlogin'])->name('login');
Route::post('/login', [registerController::class, 'login'])->name('login.user');

Route::get('/home',[ProductController::class,'index'])->middleware('auth')->name('home'); // Dashboard
Route::post('/logout', [registerController::class, 'logout'])->name('logout');
//profile
Route::get('/profile', [registerController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/profile/upload', [registerController::class, 'upload'])->name('profile.upload')->middleware('auth');
Route::get('/logout', function () {
    session()->forget('profile_image'); // Clear profile image session on logout
    session()->forget('username');
    Auth::logout();
    return redirect('/login');
})->name('logout');
Route::get('/', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');
Route::get('/invoice/{order_id}', [CartController::class, 'generateInvoice'])->name('invoice.generate');
Route::get('/mybooking', [CartController::class, 'mybooking'])->name('mybooking');
Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');

//admin site route
Route::get('/adp',[ProductController::class,'showadp'])->name('adp');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/admin/home', [ProductController::class, 'adminHome'])->name('admin.home');
Route::get('/stocks', [StockController::class, 'index'])->name('stocks');
Route::get('/stocks/update/{id}/{new_stock}', [StockController::class, 'updateStock'])->name('update.stock');//post change one time to get
Route::get('/stocks/remove/{id}', [StockController::class, 'removeProduct'])->name('stocks.remove');



