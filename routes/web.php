<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OverzichtsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
Route::get('/', function () {
    return view('auth.login');
});

Route::post('/handle-form', [FormController::class, 'handleFormSubmission']);
Route::post('/handle_WijzigKandidaatForm', [FormController::class, 'handleWijzigKandidaatForm']);


Route::get('/kandidaattoevoegen', function () {
    return view('KandidaatToevoegen');
})->middleware(['auth', 'verified'])->name('kandidaattoevoegen');

Route::get('/overzicht', [OverzichtsController::class, 'overzicht'])->name('overzicht');
Route::get('/details/{id}', [OverzichtsController::class, 'details'])->name('details');
Route::post('/kandidaat/{id}/delete', [OverzichtsController::class, 'delete'])->middleware(['auth', 'verified'])->name('delete');
Route::get('/kandidaat/{id}/wijzigen', [OverzichtsController::class, 'wijzigen'])->name('wijzigen')->middleware(['auth', 'verified'])->name('wijzigen');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
