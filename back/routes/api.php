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
Route::PUT('deleteRepublic2/{id}','RepublicController@deleteRepublic2');//->middleware('verify.user');
Route::GET('listLocatarios/{id}', 'RepublicController@listLocatarios');
Route::GET('showLocador/{id}', 'RepublicController@showLocador');
Route::GET('searchRepublic', 'RepublicController@searchRepublic');
Route::GET('deletedRepublics', 'RepublicController@deletedRepublics');

//UserController
Route::POST('createUser','UserController@createUser');
Route::GET('showUser/{id}', 'UserController@showUser');
Route::GET('listUsers','UserController@listUsers');
Route::PUT('updateUser/{id}', 'UserController@updateUser');
Route::POST('alugar/{user_id}/{republic_id}', 'UserController@alugar');
Route::POST('anunciar/{user_id}/{republic_id}', 'UserController@anunciar');
Route::PUT('favoritar/{user_id}/{republic_id}', 'UserController@favoritar');
Route::PUT('desfavoritar/{user_id}/{republic_id}', 'UserController@desfavoritar');

//Passport routes

Route::POST('register', 'API\PassportController@register');
Route::POST('login', 'API\PassportController@login');

Route::GROUP(['middleware'=>'auth:api'], function (){
    Route::GET('logout', 'API\PassportController@logout');
    Route::POST('getDetails', 'API\PassportController@getDetails');
});


