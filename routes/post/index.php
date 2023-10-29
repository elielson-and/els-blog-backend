<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Get post
Route::get('/post/{slug}', [PostController::class, 'show']);
// Create a post
// Route::post('/post/create', [PostController::class, 'store']);


Route::post('/post/create', [PostController::class, 'store']);
// Route::middleware(['auth:sanctum'])->group(function () {
// });
