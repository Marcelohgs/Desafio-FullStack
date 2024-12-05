<?php

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

Route::get('/', [\App\Http\Controllers\DevController::class,'index']);

Route::get('/dev', [\App\Http\Controllers\DevController::class,'index'])->name('app.dev');
Route::get('/dev/cadastrar', [\App\Http\Controllers\DevController::class,'ShowViewRegister'])->name('dev.view.cadastrar');
Route::get('/dev/editar/{id}', [\App\Http\Controllers\DevController::class,'ShowViewEdit'])->name('dev.view.editar');

Route::get('/nivel', [\App\Http\Controllers\NivelController::class,'index'])->name('app.nivel');
Route::get('/nivel/cadastrar', [\App\Http\Controllers\NivelController::class,'ShowViewRegister'])->name('nivel.view.cadastrar');
Route::get('/nivel/editar/{id}', [\App\Http\Controllers\NivelController::class,'ShowViewEdit'])->name('nivel.view.editar');
