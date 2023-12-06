<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PetsReportController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\SpecieController;
use Illuminate\Support\Facades\Route;

Route::post('races', [RaceController::class, 'store']);
Route::get('races', [RaceController::class, 'index']);

Route::post('species', [SpecieController::class, 'store']);
Route::get('species', [SpecieController::class, 'index']);
Route::delete('species/{id}', [SpecieController::class, 'destroy']);

Route::get('pets', [PetController::class, 'index']);
Route::post('pets', [PetController::class, 'store']);
Route::delete('pets/{id}', [PetController::class, 'destroy']);

Route::get('pets/export', [PetsReportController::class, 'export']);

Route::post('clients', [ClientController::class, 'store']);
Route::get('clients', [ClientController::class, 'index']);


Route::post('professionals', [ProfessionalController::class, 'store']);
Route::get('professionals', [ProfessionalController::class, 'index']);

