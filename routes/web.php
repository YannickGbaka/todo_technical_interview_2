<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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


Route::get('/', [TodoController::class, 'index']);
Route::get('todos', [TodoController::class, 'index']);
Route::post('todos', [TodoController::class, 'create'])->name('todos.create');
Route::delete('todos/{id}', [TodoController::class, 'destroy'])->name('todos.delete');
Route::put('todos', [TodoController::class, 'update'])->name('todos.update');
Route::post('todos/state', [TodoController::class, 'completeTask'])->name('todos.change_state');
