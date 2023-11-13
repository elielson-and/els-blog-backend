<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Get post
Route::get('/post/all', [PostController::class, 'index']);
Route::get('/post/{post}', [PostController::class, 'show']);


// Auth middleware
Route::middleware(['auth', 'is_admin'])->group(function () {
    // Create a post
    Route::post('/post/create', [PostController::class, 'store']);
    Route::patch('/post/update/{slug}', [PostController::class, 'update']);
    Route::delete('/post/delete/{slug}', [PostController::class, 'destroy']);
});
