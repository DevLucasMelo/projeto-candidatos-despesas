<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeputadoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/deputados', [DeputadoController::class, 'index'])->name('deputados.index');

Route::get('/deputados/{id}/info', [DeputadoController::class, 'info'])->name('deputados.info');

Route::get('/deputados/{id}/despesas', [DeputadoController::class, 'despesas'])->name('deputados.despesas');


