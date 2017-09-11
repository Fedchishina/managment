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


//----------------- groups  --------------------//
//fetch list of groups
Route::get('/groups', 'GroupController@index');
//create a group
Route::post('/groups', 'GroupController@store');
//fetch info of a group
Route::get('/groups/{id}', 'GroupController@show');
//modify group info
Route::post('/groups/{id}', 'GroupController@update');

//---------------- users  ---------------------//
//fetch list of users
Route::get('/users', 'UserController@index');
//create a user
Route::post('/users', 'UserController@store');
//fetch info of a user
Route::get('/users/{id}', 'UserController@show');
//modify user info
Route::post('/users/{id}', 'UserController@update');
