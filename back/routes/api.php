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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//RepublicController
Route::POST('createRepublic','RepublicController@createRepublic');
Route::GET('showRepublic/{id}','RepublicController@showRepublic');
Route::GET('listRepublics','RepublicController@listRepublics');
Route::PUT('updateRepublic/{id}','RepublicController@updateRepublic');
Route::PUT('addAnnounce/{republic_id}/{locator_id}','RepublicController@addAnnounce');
Route::PUT('removeAnnounce/{republic_id}','RepublicController@removeAnnounce');
Route::DELETE('deleteRepublic/{id}','RepublicController@deleteRepublic');

//UserController
Route::POST('createUser','UserController@createUser');
Route::GET('showUser/{id}', 'UserController@showUser');
Route::GET('listUsers','UserController@listUsers');
Route::PUT('updateUser/{id}', 'UserController@updateUser');

