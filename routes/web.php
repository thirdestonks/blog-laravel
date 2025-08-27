<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/post', [PageController::class, 'postIndex'])->name('post.index');
    Route::get('/post/create', [PageController::class, 'postCreate'])->name('post.create');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/post/index', [PostController::class, 'index']);
    Route::post('/post', [PostController::class, 'store']);
    Route::patch('/post/{id}/edit', [PostController::class, 'update']);
    Route::get('/post/{id}/comments', [PostController::class, 'getCommentsByPost']);
    Route::post('/post/{id}/comment', [PostController::class, 'commentPost']);
    Route::delete('/post/{id}', [PostController::class, 'destroy']);
});

require __DIR__.'/auth.php';
