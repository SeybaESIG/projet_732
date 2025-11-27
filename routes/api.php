<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaysController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\EnchereController;

Route::apiResource('users', UserController::class)->names([
    'index' => 'api.users.index',
    'store' => 'api.users.store',
    'show' => 'api.users.show',
    'update' => 'api.users.update',
    'destroy' => 'api.users.destroy',
]);

Route::apiResource('pays', PaysController::class)->names([
    'index' => 'api.pays.index',
    'store' => 'api.pays.store',
    'show' => 'api.pays.show',
    'update' => 'api.pays.update',
    'destroy' => 'api.pays.destroy',
]);

Route::apiResource('villes', VilleController::class)->names([
    'index' => 'api.villes.index',
    'store' => 'api.villes.store',
    'show' => 'api.villes.show',
    'update' => 'api.villes.update',
    'destroy' => 'api.villes.destroy',
]);

Route::apiResource('annonces', AnnonceController::class)->names([
    'index' => 'api.annonces.index',
    'store' => 'api.annonces.store',
    'show' => 'api.annonces.show',
    'update' => 'api.annonces.update',
    'destroy' => 'api.annonces.destroy',
]);

Route::apiResource('encheres', EnchereController::class)->names([
    'index' => 'api.encheres.index',
    'store' => 'api.encheres.store',
    'show' => 'api.encheres.show',
    'update' => 'api.encheres.update',
    'destroy' => 'api.encheres.destroy',
]);
