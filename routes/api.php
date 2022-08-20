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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //route login
    Route::post('/login', [App\Http\Controllers\Api\Admin\LoginController::class, 'index', ['as' => 'admin']]);

    //group route with middleware "auth:api_admin"
    Route::group(['middleware' => 'auth:api_admin'], function() {

        //data user
        Route::get('/user', [App\Http\Controllers\Api\Admin\LoginController::class, 'getUser', ['as' => 'admin']]);

        //refresh token JWT
        Route::get('/refresh', [App\Http\Controllers\Api\Admin\LoginController::class, 'refreshToken', ['as' => 'admin']]);

        //logout
        Route::post('/logout', [App\Http\Controllers\Api\Admin\LoginController::class, 'logout', ['as' => 'admin']]);
    
    });

});