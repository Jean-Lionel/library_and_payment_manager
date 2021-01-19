<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\PaimentController;
use App\Http\Controllers\PatrimoineController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VenteController;
use App\Http\Livewire\VenteLivewire;
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

Route::get('/', function () {
       
    return view('auth.login');
});




Route::middleware('auth')->group(function(){

Route::resource('sections', SectionController::class);
Route::resource('classes', ClasseController::class);
Route::resource('eleves', EleveController::class);
Route::resource('paiements', PaimentController::class);
Route::resource('patrimoines', PatrimoineController::class);
Route::resource('products', ProductController::class);
Route::resource('stoks', StockController::class);
Route::resource('categories', CategoryController::class);
Route::resource('ventes', VenteController::class);
Route::resource('expenses', DepenseController::class);

Route::get('rapport', [VenteController::class , 'rapport'])->name('rapport');


});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
