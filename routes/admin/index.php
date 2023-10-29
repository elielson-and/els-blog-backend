<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin-check', function () {
        return response()->json('ok admin', 200);
    });
});
