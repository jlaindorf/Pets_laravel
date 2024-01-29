<?php

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

    Route::post('races', [RaceController::class, 'store'])->middleware(['ability:create-races']);
    Route::get('races', [RaceController::class, 'index'])->middleware(['ability:get-races']);

    // BODY -> cadastrar, atualizar
    // Query paraments -> GET -> listar dados
    // Route params -> DELETE, PUT, GET(unico)->middleware(['auth:sanctum']);

    Route::post('species', [SpecieController::class, 'store'])->middleware(['ability:create-species']);
    Route::get('species', [SpecieController::class, 'index'])->middleware(['ability:get-species']);
    Route::delete('species/{id}', [SpecieController::class, 'destroy'])->middleware(['ability:delete-species']);

    Route::get('pets', [PetController::class, 'index'])->middleware(['ability:get-pets']);
    Route::post('pets', [PetController::class, 'store'])->middleware(['ability:create-pets']);
    Route::delete('pets/{id}', [PetController::class, 'destroy'])->middleware(['ability:delete-pets']);

    Route::get('pets/export', [PetsReportController::class, 'export'])->middleware(['ability:export-pdf-pets']);

    Route::post('clients', [ClientController::class, 'store'])->middleware(['ability:create-clients']);
    Route::get('clients', [ClientController::class, 'index'])->middleware(['ability:get-clients']);

    Route::post('profissionals', [ProfessionalController::class, 'store'])->middleware(['ability:create-profissionals']);
    Route::get('profissionals', [ProfessionalController::class, 'index'])->middleware(['ability:get-profissionals']);

    Route::post('vaccines', [VaccineController::class, 'store'])->middleware(['ability:create-vaccines']);

    Route::post('logout', [AuthController::class, 'logout']);
});

Route::post('login', [AuthController::class, 'store']);
Route::post('users', [UserController::class, 'store']);
