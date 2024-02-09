<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\CreditsController;
use App\Http\Controllers\Api\Credit_requestsController;


Route::controller(UsersController::class)->group(function(){
    Route::get('/users', 'index');
    Route::get('/user/read', 'read');
    Route::post('/user', 'store');
    Route::get('/user/{id}', 'show');
    Route::put('/user/{id}', 'update');
});
Route::controller(CreditsController::class)->group(function(){
    Route::get('/credits', 'index');
    Route::post('/credit', 'store');
    Route::get('/credit/{id}', 'show');
    Route::get('/credit/read/{id}', 'read');
    Route::put('/credit/{id}', 'update');
});
Route::controller(Credit_requestsController::class)->group(function(){
    Route::get('/credit_requests', 'index');
    Route::post('/credit_request', 'store');
    Route::get('/credit_request/read', 'read');
    Route::get('/credit_request/pendient', 'pendient');
    Route::get('/credit_request/{id}', 'show');
    Route::put('/credit_request/{id}', 'update');
});