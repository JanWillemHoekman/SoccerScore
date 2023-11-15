<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeamsController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\GAmesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('teams', TeamsController::class .'@index');
Route::get('teams/{team}', TeamsController::class .'@show');

Route::post('teams', TeamsController::class .'@store');
Route::put('teams/{team}', TeamsController::class .'@update');
Route::delete('teams/{team}', TeamsController::class .'@destroy');

Route::get('seasons', SeasonsController::class .'@index');
Route::get('seasons/{season}', SeasonsController::class .'@show');

Route::post('seasons', SeasonsController::class .'@store');
Route::put('seasons/{season}', SeasonsController::class .'@update');
Route::delete('seasons/{season}', SeasonsController::class .'@destroy');

Route::get('game', GamesController::class .'@show');
Route::get('games', GamesController::class .'@index');

Route::post('games', GamesController::class .'@store');
Route::put('games', GamesController::class .'@update');
Route::delete('games', GamesController::class .'@destroy');

