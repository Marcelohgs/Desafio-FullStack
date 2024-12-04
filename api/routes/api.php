<?php

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


Route::prefix('v1')->group(function () {
    Route::get('/desenvolvedores', [\App\Http\Controllers\DevController::class,'consultar']);
    Route::post('/desenvolvedores', [\App\Http\Controllers\DevController::class,'create'])->name('dev.create');
    Route::put('/desenvolvedores/{id}', [\App\Http\Controllers\DevController::class,'update'])->name('dev.update');
    Route::delete('/desenvolvedores/{id}', [\App\Http\Controllers\DevController::class,'delete']);

    //Finalizado
    Route::get('/niveis', [\App\Http\Controllers\NivelController::class,'consultar']);
    Route::post('/niveis', [\App\Http\Controllers\NivelController::class,'create'])->name('nivel.create');
    Route::put('/niveis/{id}', [\App\Http\Controllers\NivelController::class,'update'])->name('nivel.update');
    Route::delete('/nivel/{id}', [\App\Http\Controllers\NivelController::class,'delete']);
});
