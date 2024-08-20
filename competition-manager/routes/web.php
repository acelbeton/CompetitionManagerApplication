<?php

use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\CompetitorController;
use App\Http\Controllers\RoundController;
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


Route::get('/create-competition', function () {
    return view('competitions.create-competition');
})->name('create-competition');

Route::get('/competitions/create', [CompetitionController::class, 'create'])->name('competitions.create');

Route::post('/competitions-store', [CompetitionController::class, 'store'])->name('competitions.store');

Route::get('/competition-index', [CompetitionController::class, 'index'])->name('competition-index');

Route::get('rounds/{competitionId}', [RoundController::class, 'findByCompetitionId'])->name('rounds.findByCompetitionId');

Route::post('/rounds', [RoundController::class, 'store'])->name('rounds.store');

Route::resource('rounds', RoundController::class);

Route::post('rounds/destroy', [RoundController::class, 'destroy'])->name('rounds.destroy');

Route::get('competitors/{roundId}', [CompetitorController::class, 'findByRoundId'])->name('competitors.findByRoundId');

Route::post('/competitors/add', [CompetitorController::class, 'addCompetitor'])->name('competitors.store');
Route::post('/competitors/destroy', [CompetitorController::class, 'destroy']);


Route::get('/', function () {
    return view('welcome');
})->name('home');
