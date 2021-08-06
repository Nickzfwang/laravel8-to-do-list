<?php

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

Route::namespace('Todo')
    ->middleware(['api', 'auth:api'])
    ->prefix('todos')
    ->group(function () {
       Route::get('/{todoId?}', 'GetTodoList');
       Route::post('/', 'CreateOrUpdate');
       Route::put('/{todoId}', 'CreateOrUpdate');
       Route::delete('/{todoId?}', 'DeleteTodoList');
    });

Route::namespace('Todo')
    ->middleware(['api', 'auth:api'])
    ->prefix('todo')
    ->group(function () {
        Route::get('/{todoId}', 'Item\GetTodoItem');
        Route::post('/{todoId}/item', 'Item\CreateOrUpdateItem');
        Route::put('/{todoId}/item/{itemId}', 'Item\CreateOrUpdateItem');
        Route::delete('/{todoId}/item/{itemId}', 'Item\DeleteTodoItem');
    });

Route::namespace('Auth')
    ->middleware([])
    ->prefix('auth')
    ->group(function () {
        Route::post('login', 'Login');
    });

Route::namespace('Auth')
    ->middleware(['api', 'auth:api'])
    ->prefix('auth')
    ->group(function () {
       Route::post('refresh', 'RefreshToken');
       Route::get('me', 'GetUserProfile');
    });
