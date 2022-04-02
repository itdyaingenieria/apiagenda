<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\Clients\ClientsController;
use App\Http\Controllers\Appointment\AppointmentsController;
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

Route::group([
    'middleware' => 'api'
], function ($router) {

    /**
     * Authentication Module
     */
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });


    /**
     * Cliente Module
     */
    Route::resource('clients', ClientsController::class);
    Route::get('clients/view/all', [ClientsController::class, 'indexAll']);
    Route::get('clients/view/search', [ClientsController::class, 'search']);

    /**
     * Agenda Module - appointment = cita
     */
    Route::resource('appointments', AppointmentsController::class);
    // Route::get('appointments/view/all', [AppointmentsController::class, 'indexAll']);
    //  Route::get('appointments/view/search', [AppointmentsController::class, 'search']);

    //itdyaingenieria

});
