<?php

use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PetsReportController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
Route::post('users', [UserController::class, 'store'])->middleware(['auth:sanctum', 'ability:create-users']);
Route::post('races', [RaceController::class, 'store'])->middleware(['auth:sanctum', 'ability:create-races']);
Route::get('races', [RaceController::class, 'index'])->middleware(['auth:sanctum', 'ability:get-races']);

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

Route::post('vaccines', [VaccineController::class, 'store']);
Route::post('logout', [AuthController::class, 'logout']);
});

Route::post('login', [AuthController::class, 'store']);


Route::get('pets/adocao', [AdoptionController::class, 'index']);
Route::get('pets/{id}', [AdoptionController::class, 'show']);
