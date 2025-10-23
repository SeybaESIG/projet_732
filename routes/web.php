<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaysController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\EnchereController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', function (Request $request) {
    $q = $request->query('q');
    return redirect()->route('products.index', ['q' => $q]);
})->name('search');



Route::apiResource('users', UserController::class);
Route::apiResource('pays', PaysController::class);
Route::apiResource('villes', VilleController::class);
Route::apiResource('annonces', AnnonceController::class);
Route::apiResource('encheres', EnchereController::class);
