<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaysController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\EnchereController;

Route::apiResource('users', UserController::class);
Route::apiResource('pays', PaysController::class);
Route::apiResource('villes', VilleController::class);
Route::apiResource('annonces', AnnonceController::class);
Route::apiResource('encheres', EnchereController::class);

