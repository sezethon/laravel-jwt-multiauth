<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/teacher/register', 'TeachersController@register');
Route::post('/teacher/login', 'TeachersController@login');
Route::group(['middleware' => 'multiauth:teacher'], function() {
   Route::get('/teacher/me', 'TeachersController@me');
});

// Route::post('/student/register', 'StudentsController@register');
Route::post('/student/login', 'StudentsController@login');
Route::group(['middleware' => 'multiauth:student'], function() {
   Route::get('/student/me', 'StudentsController@me');
});
