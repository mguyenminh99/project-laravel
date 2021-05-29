<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login-user', function () {
    return view('login');
});
Route::get('/logout', [LoginController::class , 'logOut'])->name('user.logout');
Route::get('/register-user', function () {
    return view('register');
});
Route::post('/login-user', [LoginController::class , 'checkLogin'])->name('user.login');
Route::post('/register-user', [LoginController::class , 'register'])->name('user.register');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/shop' , [ProductController::class, 'index'])->name('products');
Route::get('/shop/category/{slug}/{id}' , [ProductController::class, 'category'])->name('category.index');
Route::get('products/{id}/{slug}' , [ProductController::class, 'detail'])->name('products.detail');
Route::get('/ajax/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('ajax.cart');
Route::get('/showCart', [ProductController::class, 'showCart'])->name('show.cart');
Route::get('/removeItemCart/{id}', [ProductController::class, 'removeItemCart'])->name('removeItem.cart');
Route::get('/changeQuantity/{id}', [ProductController::class, 'updateQuantity'])->name('cart.quantity');
Route::get('/checkCoupon', [ProductController::class, 'checkCoupon'])->name('cart.checkCoupon');
Route::post('/checkOut', [ProductController::class, 'checkOut'])->name('cart.checkout');
Route::get('/filterItem', [ProductController::class, 'filterItem'])->name('product.filter');

Route::middleware(['CheckLogin'])->group(function () {
    Route::get('/Cart', [ProductController::class, 'checkCart'])->name('cart.check');
    Route::get('/placeOrder-success', [ProductController::class, 'checkOutSuccess'])->name('payment.success');
    Route::post('users/update/{id}', [UserController::class, 'update'])->name('user.update');
    
});
Route::middleware(['CheckUser'])->group(function () {
    Route::get('/profile/{id}', [UserController::class, 'index'])->name('user.index');
});

