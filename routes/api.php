<?php

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
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

Route::group(['prefix' => 'auth'], function (Router $router) {
    $router->post('sign_up', [Controllers\AuthController::class, 'signUp']);

    $router->post('sign_in', [Controllers\AuthController::class, 'signIn']);

    $router->get('me', [Controllers\AuthController::class, 'me'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'categories'], function (Router $router) {
    $router->get('', [Controllers\CategoriesController::class, 'index']);
});

Route::group(['prefix'  => 'posts'], function (Router $router) {
    $router->get('', [Controllers\PostsController::class, 'index']);

    $router->post('', [Controllers\PostsController::class, 'create']);
});
