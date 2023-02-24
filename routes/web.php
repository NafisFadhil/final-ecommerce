<?php

use App\Http\Controllers\AlamatController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\ProdukController as ControllersProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\IndexController;
use App\Http\Controllers\Public\ProdukController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'index']);
Route::get('/product', [ProdukController::class, 'index']);
Route::get('/product/{produk}', [ProdukController::class, 'show']);

Route::middleware('guest')->group(function() {
	Route::get('/register', [RegisterController::class, 'index']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [LoginController::class, 'index'])->name('login');
	Route::post('/login', [LoginController::class, 'auth']);
});


Route::middleware('auth')->group(function() {
	Route::get('/logout', [LoginController::class, 'logout']);
	Route::get('/account', [ProfileController::class, 'index']);
	Route::post('/account', [ProfileController::class, 'update']);

	Route::get('/account/orders', [PesananController::class, 'index']);

	Route::middleware('admin')->group(function() {
		Route::resource('/account/products', ControllersProdukController::class);

		Route::get('/account/previews/{product}', [PreviewController::class, 'index']);
		Route::get('/account/previews/{product}/create', [PreviewController::class, 'create']);
		Route::get('/account/previews/{product}/{preview}/edit', [PreviewController::class, 'edit']);
		Route::put('/account/previews/{product}/{preview}', [PreviewController::class, 'update']);
		Route::post('/account/previews/{product}', [PreviewController::class, 'store']);
		Route::delete('/account/previews/{product}/{preview}', [PreviewController::class, 'destroy']);
		
		Route::resource('/account/categories', KategoriController::class);
		
		Route::resource('/account/banners', BannerController::class);
		Route::get('/account/send', [PesananController::class, 'allSend']);
		Route::post('/send', [PesananController::class, 'send']);
		Route::post('/tolak', [PesananController::class, 'reject']);

		Route::get('/account/report', [ReportController::class, 'index']);
	});
	
	Route::middleware('member')->group(function() {
		Route::post('/buy', [ProdukController::class, 'buy']);

		Route::post('/rate/{product}', [RateController::class, 'rate']);
		Route::resource('/account/address', AlamatController::class);
		
		Route::get('/account/cart', [KeranjangController::class, 'index']);
		Route::post('/checkout', [KeranjangController::class, 'checkout']);
		Route::delete('/account/cart/{cart}', [KeranjangController::class, 'destroy']);

		Route::resource('/account/testimoni', TestimoniController::class);
	});
});
