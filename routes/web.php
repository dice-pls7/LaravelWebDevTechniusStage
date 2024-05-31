<?php 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OverzichtsController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\KandidaatToevoegenController;
use App\Http\Controllers\KandidaatWijzigenController;
use App\Http\Controllers\ReviewToevoegenController;
use Illuminate\Support\Facades\Route;


Route::get('/', [OverzichtsController::class, 'overzicht'])->name('overzicht');

Route::get('/kandidaattoevoegen', function () {
    return view('KandidaatToevoegen');
})->middleware(['auth', 'verified'])->name('kandidaattoevoegen');

Route::get('/details/{id}', [OverzichtsController::class, 'details'])->name('details');
Route::post('/kandidaat/{id}/delete', [OverzichtsController::class, 'delete'])->middleware(['auth', 'verified'])->name('delete');
Route::post('/review/{id}/deleteReview', [OverzichtsController::class, 'deleteReview'])->middleware(['auth', 'verified'])->name('deleteReview');
Route::post('/kandidaat/{id}/pin', [OverzichtsController::class, 'pin'])->middleware(['auth', 'verified'])->name('pin');
Route::get('/kandidaat/{id}/wijzigen', [OverzichtsController::class, 'wijzigen'])->name('wijzigen')->middleware(['auth', 'verified'])->name('wijzigen');

// Nieuwe route voor het toevoegen van een kandidaat
Route::post('/kandidaat/toevoegen', [KandidaatToevoegenController::class, 'toevoegen'])->name('kandidaat.toevoegen');

//Nieuwe route voor het toevoegen van een review
Route::post('/review/toevoegen', [ReviewToevoegenController::class, 'toevoegen'])->name('review.toevoegen');

// Nieuwe route voor het wijzigen van een kandidaat
Route::post('/kandidaat/wijzigen', [KandidaatWijzigenController::class, 'wijzigen'])->name('kandidaat.wijzigen');

// Wijzig deze regel zodat zowel GET als POST aanvragen naar dezelfde filterfunctie verwijzen
Route::match(['get', 'post'], '/overzicht', [FilterController::class, 'filterResults'])->name('overzicht');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';