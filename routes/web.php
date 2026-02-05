<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/instalar-db', function () {
    Artisan::call('migrate --force');
    return "¡Base de datos instalada correctamente!";
});