<?php


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
       
    return view('welcome');
});

Route::get('/home', function () {
       
    return view('welcome');
});



Route::resource('sections', 'SectionController');
Route::resource('classes', 'ClasseController');
Route::resource('eleves', 'EleveController');
Route::resource('paiements', 'PaimentController');
Route::resource('patrimoines', 'PatrimoineController');
Route::resource('products', 'ProductController');
Route::resource('stoks', 'StockController');
Route::resource('categories', 'CategoryController');
Route::resource('ventes', 'VenteController');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
