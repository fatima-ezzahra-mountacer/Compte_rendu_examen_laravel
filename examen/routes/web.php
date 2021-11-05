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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\LivreController::class, "index"])->name('index');
Route::get('/create', [App\Http\Controllers\LivreController::class, "create"])->name('create');
Route::post('/store', [App\Http\Controllers\LivreController::class, "store"])->name('store');
Route::get('/edit/{id}', [App\Http\Controllers\LivreController::class, "edit"])->name('edit');
Route::put('/update/{id}', [App\Http\Controllers\LivreController::class, "update"])->name('update');
Route::delete('/delete/{id}', [App\Http\Controllers\LivreController::class, "destroy"])->name('delete');