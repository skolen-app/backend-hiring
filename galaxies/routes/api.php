<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\GalaxyController;
use App\Http\Controllers\Api\SolarSystemController;
use App\Http\Controllers\Api\PlanetController;

// Register user
Route::post('register', [UserController::class, 'store']);

// Login
Route::post('auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['apiJwt']], function () {
    // Logout
    Route::post('auth/logout', [AuthController::class, 'logout']);

    // Create new galaxy
    Route::post('galaxy', [GalaxyController::class, 'store']);

    // List galaxies
    Route::get('galaxies', [GalaxyController::class, 'index']);

    // List single galaxy
    Route::get('galaxy/{id}', [GalaxyController::class, 'show']);

    // Update galaxy
    Route::put('galaxy/{id}', [GalaxyController::class, 'update']);

    // Delete galaxy
    Route::delete('galaxy/{id}', [GalaxyController::class, 'destroy']);


    // Create new solar system
    Route::post('galaxies/{galaxyId}/solar-system', [SolarSystemController::class, 'store']);

    // List solar systems
    Route::get('solar-systems', [SolarSystemController::class, 'index']);

    // List single solar system
    Route::get('solar-system/{id}', [SolarSystemController::class, 'show']);

    // Update solar system
    Route::put('solar-system/{id}', [SolarSystemController::class, 'update']);

    // Delete solar system
    Route::delete('solar-system/{id}', [SolarSystemController::class, 'destroy']);


    // Create new planet
    Route::post('solar-systems/{solarSystemId}/planet', [PlanetController::class, 'store']);

    // List planets
    Route::get('planets', [PlanetController::class, 'index']);

    // List single planet
    Route::get('planet/{id}', [PlanetController::class, 'show']);

    // Update planet
    Route::put('planet/{id}', [PlanetController::class, 'update']);

    // Delete planet
    Route::delete('planet/{id}', [PlanetController::class, 'destroy']);
});


