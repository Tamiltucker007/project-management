<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Admin 
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('projects', ProjectController::class);
        Route::resource('tasks', TaskController::class);
        Route::resource('users', UserController::class);
    });
    
    // Project Manager 
    Route::middleware(['role:project-manager'])->group(function () {
        Route::resource('projects', ProjectController::class)->except(['destroy']);
        Route::resource('tasks', TaskController::class)->except(['destroy']);
    });

     // Team Member 
    Route::middleware(['role:team-member'])->group(function () {
        Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
        Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    });
});
    

