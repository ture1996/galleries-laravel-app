<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
});

Route::get('galleries', 'GalleryController@index');
Route::get('galleries/{id}', 'GalleryController@show');
Route::post('galleries', 'GalleryController@store');
Route::put('galleries/{id}', 'GalleryController@update');
Route::delete('galleries/{id}', 'GalleryController@destroy');

Route::get('authors/{id}', 'UserController@show');

Route::post('galleries/{id}/comments', 'CommentController@store');
Route::delete('galleries/comments/{id}', 'CommentController@destroy');
