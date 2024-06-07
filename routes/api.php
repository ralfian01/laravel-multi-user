<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\REST\V1 as RESTV1;

Route::middleware('auth:bearer')->match(
    ['post', 'delete'],
    '/',
    [RESTV1\RESTV1::class, 'index']
);

Route::middleware('auth:basic')->match(
    ['patch', 'put'],
    '/',
    [RESTV1\RESTV1::class, 'index']
);

Route::middleware('auth:key')->match(
    ['get'],
    '/',
    [RESTV1\RESTV1::class, 'index']
);

// Route::match(
//     ['get', 'post', 'patch', 'put', 'delete'],
//     '/',
//     [RESTV1\RESTV1::class, 'index']
// );
