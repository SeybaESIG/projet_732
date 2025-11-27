<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Web\AnnoncePageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/home', 'welcome');

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])
    ->name('auth.google.redirect');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])
    ->name('auth.google.callback');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::view('/contact', 'contact')->name('contact');

Route::view('/annonces', 'annonces.index')->name('annonces.browse');
Route::middleware('auth')->group(function () {
    Route::get('/annonces/publier', [AnnoncePageController::class, 'create'])->name('annonces.create');
    Route::post('/annonces', [AnnoncePageController::class, 'store'])->name('annonces.store');
});
Route::view('/annonces/alerte', 'annonces.alert')->name('annonces.alert');
Route::view('/tableau-de-bord', 'dashboard.index')->name('dashboard');
Route::view('/profil', 'profile.index')->name('profile');
Route::view('/inscription', 'auth.register')->name('register');
Route::view('/connexion', 'auth.login')->name('login');
