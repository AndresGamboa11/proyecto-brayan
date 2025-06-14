<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\AutoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



// LOGIN / LOGOUT
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// REGISTER
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);



Route::get('/dashboard-user', [AutoController::class, 'dashboardUser'])
    ->name('dashboard-user');

Route::get('/dashboard-admin', [AutoController::class, 'dashboardAdmin'])
    ->name('dashboard-admin');


Route::post('/autos', [AutoController::class, 'store'])->name('autos.store');



Route::middleware(['auth'])->group(function () {
    Route::resource('autos', AutoController::class);
    Route::delete('/autos/{id}', [AutoController::class, 'destroy'])->name('autos.destroy');
    Route::get('/autos/{id}', [AutoController::class, 'show'])->name('autos.show');

});


Route::get('/catalogo/{marca}', [CatalogoController::class, 'mostrarPorMarca'])
    ->name('catalogo.marca');



require __DIR__.'/auth.php';
