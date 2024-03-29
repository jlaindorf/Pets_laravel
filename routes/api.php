<?php

use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportPeoplesController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PetsReportController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineController;
use Illuminate\Support\Facades\Route;


Route::get('pets/adocao', [AdoptionController::class, 'index']);
Route::get('pets/{id}/adocao', [AdoptionController::class, 'show']);
Route::post('login', [AuthController::class, 'store']); // ok
Route::post('pets/adocao', [AdoptionController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('races', [RaceController::class, 'index'])->middleware(['ability:get-races']); // ok
    Route::post('races', [RaceController::class, 'store'])->middleware(['ability:create-races']); // ok

    Route::get('species', [SpecieController::class, 'index'])->middleware(['ability:get-species']);
    Route::post('species', [SpecieController::class, 'store'])->middleware(['ability:create-species']);
    Route::delete('species/{id}', [SpecieController::class, 'destroy'])->middleware(['ability:delete-species']);

    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('pets/perfil', [PetsReportController::class, 'showPerfil']);
    Route::get('pets/export', [PetsReportController::class, 'export'])->middleware(['ability:export-pdf-pets']);
    Route::get('pets', [PetController::class, 'index'])->middleware(['ability:get-pets']);
    Route::post('pets', [PetController::class, 'store'])->middleware(['ability:create-pets']);
    Route::delete('pets/{id}', [PetController::class, 'destroy'])->middleware(['ability:delete-pets']);
    Route::get('pets/{id}', [PetController::class, 'show'])->middleware(['ability:get-pets']);
    Route::put('pets/{id}', [PetController::class, 'update'])->middleware(['ability:create-pets']);

    Route::post('clients', [ClientController::class, 'store'])->middleware(['ability:create-clients']);
    Route::get('clients', [ClientController::class, 'index'])->middleware(['ability:get-clients']);

    Route::post('profissionals', [ProfessionalController::class, 'store'])->middleware(['ability:create-profissionals']);
    Route::get('profissionals', [ProfessionalController::class, 'index'])->middleware(['ability:get-profissionals']);

    Route::get('vacinacao/{id}/pets', [VaccineController::class, 'index'])->middleware(['ability:create-vaccines']);
    Route::post('vaccines', [VaccineController::class, 'store'])->middleware(['ability:create-vaccines']);

    Route::post('users', [UserController::class, 'store'])->middleware(['ability:create-users']);
    Route::get('users', [UserController::class, 'index'])->middleware(['ability:create-users']);

    Route::get('adoptions', [AdoptionController::class, 'getAdoptions']);

    Route::post('adoptions/realized', [AdoptionController::class, 'approve']);
});

Route::post('upload', [AdoptionController::class, 'upload']);
Route::post('import/peoples', [ImportPeoplesController::class, 'import']);
Route::get('dashboard/species', [DashboardController::class, 'getSpeciesAmountByPet']);
Route::get('dashboard/clients', [DashboardController::class, 'getClientsAmountByMonth']);
