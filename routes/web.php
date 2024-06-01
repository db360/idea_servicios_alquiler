<?php

use App\Http\Controllers\PropertyController;
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

Route::prefix('properties')->group(function(){

    Route::get('/', [PropertyController::class, 'index'])->name('properties');
    Route::get('/create', [PropertyController::class, 'create']);
    Route::post('/create', [PropertyController::class, 'store'])->name('create');
    Route::get('/{id}', [PropertyController::class, 'show'])->name('properties.show');
    Route::delete('/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    Route::get('/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/{id}/update', [PropertyController::class, 'update'])->name('properties.update');

});



