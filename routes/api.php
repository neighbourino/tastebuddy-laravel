<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::prefix('v1')->middleware('setlocale')->group(function () {

    Route::get('flavours', [\App\Http\Controllers\API\FlavourController::class, 'index']);
   # Route::apiResource('flavours.pairings', \App\Http\Controllers\API\FlavourPairingController::class);

    Route::get('flavourPairing/{id}', \App\Http\Controllers\API\ShowFlavourPairingController::class);

});
