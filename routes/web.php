<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'show'])->name('allPost');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/posts', [PostController::class, 'show'])->name('allPost');

Route::get('/dashboard/posts', [PostController::class, 'showAuthPost'])->middleware(['auth', 'verified'])->name('posts');

Route::get('/dashboard/posts/create', function () {
    return Inertia::render('CreatePost');
})->middleware(['auth', 'verified'])->name('createPost');

Route::post('/dashboard/posts', [PostController::class, 'store'])->middleware(['auth', 'verified'])->name('storePost');


require __DIR__.'/auth.php';
