<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APIs\ApiController;
use App\Http\Controllers\APIs\AuthController;

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
Route::controller(AuthController::class)->group(function(){
    Route::post('auth/login', 'login');
});
Route::group(['middleware'  => ['auth:sanctum']], function(){
    Route::controller(AuthController::class)->group(function(){
        Route::get('auth/me', 'me');
        Route::post('auth/logout', 'logout');
    });

    Route::controller(ApiController::class)->group(function(){
        Route::get('getData', 'show');
        Route::post('updateTask', 'updateTask');
        Route::post('createTask', 'createTask');
        Route::post('uploadImages', 'imageStore');
        // test api
        Route::post('test', 'test');
    });
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
