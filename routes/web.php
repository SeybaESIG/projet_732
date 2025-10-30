<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', function (Request $request) {
    $q = $request->query('q');
    return redirect()->route('products.index', ['q' => $q]);
})->name('search');


