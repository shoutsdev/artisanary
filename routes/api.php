<?php

use App\Http\Controllers\Api\BlogController;
use Illuminate\Support\Facades\Route;

Route::post('login', [\App\Http\Controllers\Api\LoginController::class, 'login'])->name('login');

Route::resource('blogs', BlogController::class)->except(['edit','create','update'])->middleware('jwt_auth');
Route::post('blogs/{id}', [BlogController::class, 'update'])->name('blogs.update')->middleware('jwt_auth');
