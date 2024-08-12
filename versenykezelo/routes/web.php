<?php

use App\Http\Controllers\CompetitionController;
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

Route::post('/competitions', [CompetitionController::class, 'store'])->name('competitions.store');

Route::get('/', function () {
    return view('welcome');
});
