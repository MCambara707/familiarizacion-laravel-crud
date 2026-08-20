<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/productos');

Route::resource('productos', ProductoController::class)->except(['show']);
Route::resource('clientes', ClienteController::class)->except(['show']);