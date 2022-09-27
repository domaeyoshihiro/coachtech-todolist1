<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index'])->middleware('auth');
Route::post('/add', [TodoController::class, 'create']);
Route::post('/edit/{id}', [TodoController::class, 'update']);
Route::post('/delete/{id}', [TodoController::class, 'remove']);
Route::get('/find', [TodoController::class, 'find']);
Route::get('/search', [TodoController::class, 'search'])->name('search');

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
