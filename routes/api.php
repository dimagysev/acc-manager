<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function (){
    Route::middleware('auth:sanctum')->group(function (){
        Route::resource('accounts', 'AccountController')->except('show', 'create', 'edit');
        Route::resource('services', 'ServiceController')->except('show', 'create', 'edit');
        Route::post('logout', 'AuthController@logout');
    });
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
});

