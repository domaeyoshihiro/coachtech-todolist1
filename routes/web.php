<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index']);
Route::post('/add', [TodoController::class, 'create']);
Route::post('/edit/{id}', [TodoController::class, 'update']);
Route::post('/delete/{id}', [TodoController::class, 'remove']);