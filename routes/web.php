<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeputadoController;

Route::redirect('/', '/deputados');

Route::get('/deputados', [DeputadoController::class, 'index'])->name('deputados.index');

Route::get('/deputados/{id}/info', [DeputadoController::class, 'info'])->name('deputados.info');

Route::get('/deputados/{id}/despesas', [DeputadoController::class, 'despesas'])->name('deputados.despesas');

Route::get('/dashboard', [DeputadoController::class, 'dashboard'])->name('dashboard');

Route::get('/deputados/comparar', [DeputadoController::class, 'comparar'])->name('deputados.comparar');
