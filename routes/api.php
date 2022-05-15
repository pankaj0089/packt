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

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/user', function (Request $request) {
      return $request->user();
  });
  Route::get('/authors', [App\Http\Controllers\ApiController::class, 'getAuthors']);
  Route::get('/posts', [App\Http\Controllers\ApiController::class, 'getPosts']);
  Route::post('/author', [App\Http\Controllers\ApiController::class, 'getAuthorById']);
  Route::post('/post', [App\Http\Controllers\ApiController::class, 'getPostById']);
});
