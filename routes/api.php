<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\REST\V1 as RESTV1;
use App\Http\Controllers\REST\Errors;

## Example API Route
Route::post('/', [RESTV1\Home::class, 'index']);

## Example API Authorization
Route::post('login', [RESTV1\Auth\Account::class, 'index'])
    ->middleware(['auth:basic']);

## Example API Endpoint with privileges
Route::get('endpoint1', [RESTV1\Endpoints\Endpoint1::class, 'index'])
    ->middleware(['auth:bearer']);

Route::get('endpoint2', [RESTV1\Endpoints\Endpoint2::class, 'index'])
    ->middleware(['auth:bearer']);

## Custom 404
Route::any('{any}', function ($any) {
    return (new Errors)
        ->setInternal(false)
        ->setMessage(404, "Endpoint or HTTP method not available")
        ->sendError();
});
