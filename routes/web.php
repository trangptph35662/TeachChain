<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });


// Auth::routes();
Route::get('auth/login', [LoginController::class, 'showFormLogin'])->name('login') ;
Route::post('auth/login', [LoginController::class, 'login']);
Route::get('auth/logout', [LoginController::class, 'logout'])->name('logout') ;

Route::get('auth/register', [RegisterController::class, 'showFormRegister'])->name('register') ;
Route::post('auth/register', [RegisterController::class, 'register']) ;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('product/{slug}', [ProductController::class,'detail'])->name('product.detail') ;
// mua bán hàng
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add') ;
Route::get('cart/list', [CartController::class, 'list'])->name('cart.list') ;
Route::post('order/save', [OrderController::class, 'save'])->name('order.save');

