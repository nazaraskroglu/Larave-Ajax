<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//USER
Route::get('/user', 'App\Http\Controllers\UserController@index');
Route::post('/user/store', 'App\Http\Controllers\UserController@store');
Route::get('/user/edit/{id}', 'App\Http\Controllers\UserController@edit');
Route::put('/user/update/{id}', 'App\Http\Controllers\UserController@update');
Route::delete('/user/delete/{id}', 'App\Http\Controllers\UserController@destroy');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
