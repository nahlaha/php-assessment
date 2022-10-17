<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
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

Route::post('/example', [ExampleController::class, 'create']);
Route::get('/example', [ExampleController::class, 'get']);
Route::get('/example/{id}', [ExampleController::class, 'getOne']);
Route::put('/example/{id}/update', [ExampleController::class, 'update']);
Route::delete('/example/{id}/delete', [ExampleController::class, 'delete']);

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'users'], function () {

        Route::post('/', [UserController::class, 'createUser'])->middleware('jwt.auth');

        Route::get('/', [UserController::class, 'createUser'])->middleware('jwt.auth');

        Route::group(['prefix' => '{id}'], function () {

            Route::put('/', [UserController::class, 'updateUser'])->middleware('jwt.auth');

            Route::delete('/', [UserController::class, 'deleteUser'])->middleware('jwt.auth');
        });

        Route::group(['prefix' => 'actions'], function () {

            Route::post('auth',  [UserController::class, 'authenticateUser']);

            Route::get('me', [UserController::class, 'getLoggedInUser'])->middleware('jwt.auth');
        });
    });

    Route::group(['prefix' => 'stores'], function () {

        Route::post('/', [StoreController::class, 'createStore'])->middleware('jwt.auth');
    });

    Route::group(['prefix' => 'products'], function () {

        Route::post('/', [ProductController::class, 'createProduct'])->middleware('jwt.auth');

        Route::group(['prefix' => '{id}'], function () {

            Route::delete('/', [ProductController::class, 'deleteProduct'])->middleware('jwt.auth');
        });
    });
});
