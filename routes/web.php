<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EncuestaController;

Route::get('/encuestas', function () {
    return view('encuestas/index');
});

// routes/web.php
Route::post('/encuestas/areas', [EncuestaController::class, 'getEncuestaAreas'])->name('encuestas.areas');
Route::post('/encuestas/guardar', [EncuestaController::class, 'guardar'])->name('encuestas.guardar');
Route::post('/encuestas/cargar_preguntas', [EncuestaController::class, 'cargarPreguntas'])->name('encuestas.cargarPreguntas');
