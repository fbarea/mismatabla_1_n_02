<?php

use App\Http\Controllers\MainController;
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

Route::get('/', 'App\Http\Controllers\MainController@index')->name('inicio'); 

Route::get('listado/{type}',[MainController::class,'list'])->name('categories.list');
Route::get('nueva',[MainController::class,'create'])->name('categories.create');
Route::post('grabar',[MainController::class,'store'])->name('categories.store');
Route::get('editar/{id}',[MainController::class,'edit'])->name('categories.edit');
Route::post('update',[MainController::class,'update'])->name('categories.update');
Route::get('borrar_prev/{id}',[MainController::class,'previous_delete'])->name('categories.previous_delete');
Route::get('borrar/{id}',[MainController::class,'delete'])->name('categories.delete');