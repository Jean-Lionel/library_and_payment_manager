<?php

use App\Http\Controllers\BibliothequeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\BulletinGeneratorContoller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\CourController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PaimentController;
use App\Http\Controllers\PalmaresController;
use App\Http\Controllers\PatrimoineController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\EcoleController;
use App\Http\Livewire\ConfigurationComponent;
use App\Http\Livewire\NotificationSweetAlert;
use App\Http\Livewire\ParentComponent;
use App\Http\Livewire\VenteLivewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\TerritoireController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\PresenceController;
use App\Http\Livewire\HoraireComponent;
use App\Http\Livewire\RepetiteurComponent;
use App\Http\Controllers\HoraireController;
use App\Http\Controllers\RepetiteurController;

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
Route::get('notification-sweetalert', NotificationSweetAlert::class);



Route::middleware('auth')->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    });
    // Route::get('/accueil', function () {
    //     return view('welcome');
    // })->name('accueil');
    Route::get('/accueil', [AccueilController::class, 'index'])->name('accueil');
    Route::get('generate-pdf', [PDFController::class, 'generatePDF']);
    Route::resource('sections', SectionController::class);
    Route::resource('classes', ClasseController::class);
    Route::resource('cours', CourController::class);
    Route::resource('eleves', EleveController::class);
    Route::resource('paiements', PaimentController::class);
    Route::get('parents', ParentComponent::class)->name('parents');
    Route::resource('patrimoines', PatrimoineController::class);
    Route::resource('products', ProductController::class);
    Route::resource('stoks', StockController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('ventes', VenteController::class);
    Route::resource('expenses', DepenseController::class);
    Route::resource('configurations', ConfigurationController::class);
    Route::resource('ecoles', EcoleController::class);
    Route::resource('provinces', ProvinceController::class);
    Route::resource('territoires', TerritoireController::class);
    Route::resource('presences', PresenceController::class);

    Route::get('bibliotheque', [BibliothequeController::class, 'index'])->name('bibliotheque');

    Route::get('get_palmares/{annee_scolaire_id}/{classe_id}/{trimestre}', [PalmaresController::class, 'getPalmares'])->name('get_palmares');

    Route::view('palmares','courses.palmares')->name('palmares');
    //Profil
    Route::view('profiles','profiles.profile')->name('profiles');

    Route::get('effectif', [RapportController::class, 'effectif'])->name('effectif');
    Route::get('configurations_component', ConfigurationComponent::class)->name('configurations_component');
    Route::get('get_effectifs/{anne_scolaire_id}', [RapportController::class, 'getEffectifs'])->name('get_effectifs');

    Route::get('etageres', [BibliothequeController::class, 'etageres'])->name('etageres');
    Route::get('history', [BibliothequeController::class, 'history'])->name('history');

    Route::get('books', [BibliothequeController::class, 'books'])->name('books');

    Route::get('etagers', [BibliothequeController::class, 'etagers'])->name('etagers');
    Route::get('professeurs', [BibliothequeController::class, 'professeurs'])->name('professeurs');
    Route::get('lecteurs', [BibliothequeController::class, 'lecteurs'])->name('lecteurs');
    Route::get('empruts', [BibliothequeController::class, 'empruts'])->name('empruts');
    Route::get('classements', [BibliothequeController::class, 'classements'])->name('classements');
    Route::get('retourlivre', [BibliothequeController::class, 'retourlivre'])->name('retourlivre');
    Route::view("evaluations","courses.evaluation")->name("evaluations");
    Route::view('evaluations/{id}','courses.points')->name('add_point');
    Route::get('rapport', [VenteController::class , 'rapport'])->name('rapport');

    // Route::get('bulletin/{id}', [BulletinController::class , 'bulletin'])->name('bulletin_generate');
    Route::get('bulletin/{id}', [BulletinGeneratorContoller::class , 'bulletin'])->name('bulletin_generate');
    Route::get('liste_point', [BulletinController::class , 'liste_point'])->name('liste_point');
    Route::get('notes', [BulletinController::class , 'notes'])->name('notes');

    Route::post('get_notes', [BulletinController::class , 'get_notes'])->name('get_notes');

    Route::post('save_student', [EleveController::class , 'SaveList'])->name('save_student');

    Route::view('course_categories','courses.categories')->name('course_categories');
    Route::view('bullettin','courses.bullettin')->name('bullettin');
    Route::view('utilisateur','users.utilisateur')->name('utilisateur');
    // Route::get('horaire', HoraireComponent::class)->name('horaire');
    Route::view('horaire', 'horaire.create')->name('horaire');
    Route::post('addhoraire', [HoraireController::class, 'store'])->name('horaire.create');
    Route::view('repetiteur', 'repetiteur.create')->name('repetiteur');

});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('level', App\Http\Controllers\LevelController::class);

Route::resource('type-evaluation', App\Http\Controllers\TypeEvaluationController::class)->only('index');
