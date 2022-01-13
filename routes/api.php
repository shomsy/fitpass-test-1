<?php

use App\Http\Controllers\API\GymAPIController;
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

Route::get('reception/{gym}/{card}', [GymAPIController::class, 'reception'])->whereAlphaNumeric(['gym', 'card']);
