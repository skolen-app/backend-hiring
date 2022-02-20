<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\GalaxyController;
use App\Http\Controllers\SolarSystemController;
use App\Http\Controllers\PlanetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('user-create', [RegisteredUserController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth')->group(function () {
    Route::get('/user/{id}', function ($id) {
        return new UserResource(User::findOrFail($id));
    });

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
    Route::post('solar_system', [SolarSystemController::class, 'store']);

    // List solar systems
    Route::get('solar_systems', [SolarSystemController::class, 'index']);

    // List single solar system
    Route::get('solar_system/{id}', [SolarSystemController::class, 'show']);

    // Update solar system
    Route::put('solar_system/{id}', [SolarSystemController::class, 'update']);

    // Delete solar system
    Route::delete('solar_system/{id}', [GalaxyController::class, 'destroy']);


    // Create new planet
    Route::post('planet', [PlanetController::class, 'store']);

    // List planets
    Route::get('planets', [PlanetController::class, 'index']);

    // List single planet
    Route::get('planet/{id}', [PlanetController::class, 'show']);

    // Update planet
    Route::put('planet/{id}', [PlanetController::class, 'update']);

    // Delete planet
    Route::delete('planet/{id}', [PlanetController::class, 'destroy']);
//});

