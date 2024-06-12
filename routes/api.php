<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\REST\V1 as RESTV1;
use App\Http\Controllers\REST\Errors;


## Authorization
Route::post('/', [RESTV1\RESTV1::class, 'index'])
    ->middleware(['auth:basic']);

## Custom 404
Route::fallback(function () {
    return (new Errors)
        ->setInternal(false)
        ->setMessage(404, "Endpoint or HTTP method not available")
        ->sendError();
});
