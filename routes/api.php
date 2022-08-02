<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeController;
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

//http://127.0.0.1:8000/api/v1/seedfit/
Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'seedfit'], function () {
        //Rutas auth
        Route::group([
            'prefix' => 'auth'
        ], function ($router) {
            Route::post('login', [AuthController::class, 'login']);
            Route::post('register', [AuthController::class, 'register']);
            Route::post('logout', [AuthController::class, 'logout']);
        });
        //Rutas roles
        Route::group([
            'prefix' => 'role'
        ], function ($router) {
            Route::get('', [RoleController::class, 'index']);
        });
        //Rutas tipos
        Route::group([
            'prefix' => 'type'
        ], function ($router) {
            Route::get('', [TypeController::class, 'index']);
        });
        //Rutas sizes
        Route::group([
            'prefix' => 'size'
        ], function ($router) {
            Route::get('', [SizeController::class, 'index']);
            Route::patch(
                '/{id}',
                [
                    SizeController::class,
                    'update'
                ]
            );
            Route::get('/{id}', [SizeController::class, 'show']);
        });
        //Rutas categories
        Route::group([
            'prefix' => 'category'
        ], function ($router) {
            Route::get('', [CategoryController::class, 'index']);
            Route::patch(
                '/{id}',
                [
                    CategoryController::class,
                    'update'
                ]
            );
            Route::get('/{id}', [CategoryController::class, 'show']);
        });
        //Rutas storages
        Route::group([
            'prefix' => 'storage'
        ], function ($router) {
            Route::get('', [StorageController::class, 'index']);
        });
        //Rutas transacciones
        Route::group([
            'prefix' => 'transaction'
        ], function ($router) {
            Route::get('', [TransactionController::class, 'index']);
            Route::get('', [TransactionController::class, 'index'])->middleware(['auth:api', 'scope:administrador,operario']);
            Route::post('', [TransactionController::class, 'store'])->middleware(['auth:api', 'scope:administrador,operario']);
            Route::get('/{id}', [TransactionController::class, 'show']);
        });
        //Rutas proveedores
        Route::group([
            'prefix' => 'provider'
        ], function ($router) {
            Route::get('', [ProviderController::class, 'index']);
            Route::post('', [ProviderController::class, 'store']);
            Route::patch(
                '/{id}',
                [
                    ProviderController::class,
                    'update'
                ]
            );
            Route::get('/{id}', [ProviderController::class, 'show']);
        });
        //Rutas agentes
        Route::group([
            'prefix' => 'agent'
        ], function ($router) {
            Route::get('', [AgentController::class, 'index']);
            Route::post('', [AgentController::class, 'store']);
            Route::patch(
                '/{id}',
                [
                    AgentController::class,
                    'update'
                ]
            );
            Route::get('/{id}', [AgentController::class, 'show']);
        });
        //Rutas productos
        Route::get('', [ProductController::class, 'index']);
        Route::get('sum', [ProductController::class, 'sum']);
        Route::get('all', [ProductController::class, 'all']);
        Route::post('', [ProductController::class, 'store'])->middleware(['auth:api', 'scopes:administrador']);
        Route::patch('/{id}', [ProductController::class, 'update'])->middleware(['auth:api', 'scopes:administrador']);
        Route::get('/{id}', [ProductController::class, 'show']);
    });
});
