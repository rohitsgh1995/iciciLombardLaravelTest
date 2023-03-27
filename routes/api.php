<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TravellerController;
use App\Http\Controllers\API\CityController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/traveller')->group(function() { //------------------------------------------ travller routes
    Route::get('/list', [TravellerController::class, 'index']);
    Route::get('/id/{id}', [TravellerController::class, 'travellerById']);
    Route::get('/id/{id}/travel-history', [TravellerController::class, 'travellerTravelHistory']);
});

Route::prefix('/city')->group(function() { //------------------------------------------ city routes
    Route::get('/traveller-count', [CityController::class, 'distinctTraveller']);
});
