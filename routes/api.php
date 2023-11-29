<?php

use App\Http\Controllers\PetController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\SpecieController;
use Illuminate\Support\Facades\Route;

Route::post('races', [RaceController::class, 'store']);
Route::get('races', [RaceController::class, 'index']);

Route::post('species', [SpecieController::class, 'store']);
Route::get('species', [SpecieController::class, 'index']);

Route::get('pets', [PetController::class, 'index']);
Route::post('pets', [PetController::class, 'store']);
