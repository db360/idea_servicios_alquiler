<?php

use App\Http\Controllers\Api\PropertyAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('properties')->group(function(){

    Route::get('/', [PropertyAPIController::class, 'index'])->name('properties');
    Route::post('/create', [PropertyAPIController::class, 'store'])->name('properties.create');
    Route::get('/{id}', [PropertyAPIController::class, 'show'])->name('properties.show');
    Route::put('/{id}/update', [PropertyAPIController::class, 'update'])->name('properties.update');
    Route::delete('/{id}', [PropertyAPIController::class, 'destroy'])->name('properties.destroy');


});