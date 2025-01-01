<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
use App\Http\Controllers\PersonController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\CategoryController;

// Person Routes
Route::prefix('person')->group(function() {
    Route::get('/', [PersonController::class, 'index']);  // Get all people
    Route::get('/{id}', [PersonController::class, 'show']);  // Get a single person
});

// Admin Routes
Route::prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'index']);  // Get all admins
    Route::get('/{id}', [AdminController::class, 'show']);  // Get a specific admin
});

// Post Routes
Route::prefix('posts')->group(function() {
    Route::get('/', [PostController::class, 'index']);  // Get all posts
    Route::post('/', [PostController::class, 'store']);  // Create a new post
    Route::get('/{id}', [PostController::class, 'show']);  // Get a specific post
    Route::put('/{id}', [PostController::class, 'update']);  // Update a post
    Route::delete('/{id}', [PostController::class, 'destroy']);  // Delete a post
});

// Comment Routes
Route::prefix('comments')->group(function() {
    Route::post('/', [CommentController::class, 'store']);  // Create a new comment
    Route::put('/{id}', [CommentController::class, 'update']);  // Update a comment
    Route::delete('/{id}', [CommentController::class, 'destroy']);  // Delete a comment
});

// Report Routes
Route::prefix('reports')->group(function() {
    Route::get('/', [ReportController::class, 'index']);  // Get all reports
    Route::post('/', [ReportController::class, 'store']);  // Create a new report
    Route::put('/{id}', [ReportController::class, 'update']);  // Update a report
});

// Vote Routes
Route::prefix('votes')->group(function() {
    Route::post('/', [VoteController::class, 'store']);  // Vote on a post or comment
    Route::delete('/{id}', [VoteController::class, 'destroy']);  // Remove a vote
});

// Category Routes
Route::prefix('categories')->group(function() {
    Route::get('/', [CategoryController::class, 'index']);  // Get all categories
    Route::post('/', [CategoryController::class, 'store']);  // Create a new category
    Route::put('/{id}', [CategoryController::class, 'update']);  // Update a category
    Route::delete('/{id}', [CategoryController::class, 'destroy']);  // Delete a category
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
