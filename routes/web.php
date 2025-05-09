<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehiculeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::prefix('agences')->name('agences.')->group(function () {
    Route::get('/', [AgenceController::class, 'index'])->name('index');
    Route::get('/create', [AgenceController::class, 'create'])->name('create');
    Route::post('/', [AgenceController::class, 'store'])->name('store');
    Route::get('/{id}', [AgenceController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [AgenceController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AgenceController::class, 'update'])->name('update');
    Route::delete('/{id}', [AgenceController::class, 'destroy'])->name('destroy');
});

Route::prefix('vehicules')->name('vehicules.')->group(function () {
    Route::get('/', [VehiculeController::class, 'index'])->name('index');
    Route::get('/create', [VehiculeController::class, 'create'])->name('create');
    Route::post('/', [VehiculeController::class, 'store'])->name('store');
    Route::get('/{id}', [VehiculeController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [VehiculeController::class, 'edit'])->name('edit');
    Route::put('/{id}', [VehiculeController::class, 'update'])->name('update');
    Route::delete('/{id}', [VehiculeController::class, 'destroy'])->name('destroy');
});
Route::middleware(['auth'])->group(function () {
    // Afficher la liste des utilisateurs
    Route::get('/users', [UserController::class, 'index'])->name('user.index');

    // Afficher le formulaire pour créer un nouvel utilisateur
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');

    // Enregistrer un nouvel utilisateur
    Route::post('/users', [UserController::class, 'store'])->name('user.store');

    // Afficher un utilisateur spécifique
    Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');

    // Afficher le formulaire pour modifier un utilisateur spécifique
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');

    // Mettre à jour les informations d'un utilisateur
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');

    // Supprimer un utilisateur spécifique
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});
