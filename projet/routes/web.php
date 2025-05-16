<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

// Public routes
Route::get('/', [RegisterController::class, 'showRegisterForm'])->name('showregister');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/loginform', [LoginController::class, 'showLoginForm'])->name('loginform');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');
// Protected routes
Route::middleware('auth')->group(function () {

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    Route::get('/admin/pending-users', [AdminController::class, 'pendingUsers'])->name('admin.pendingUsers');
    Route::post('/admin/approve-user/{id}', [AdminController::class, 'approveUser'])->name('admin.approveUser');
    Route::post('/admin/reject-user/{id}', [AdminController::class, 'rejectUser'])->name('admin.rejectUser');
    });

    // user
    Route::middleware('role:user')->prefix('user')->group(function () {
            Route::get('/dashboard',[UserController::class,'showMeetingNote'])->name('user.dashboard');
            
Route::get('/needs', [UserController::class, 'index'])->name('needs.index');
Route::post('/needs/store', [UserController::class, 'storeNeeds'])->name('needs.store');
Route::put('/needs/{id}', [UserController::class, 'update'])->name('needs.update');
Route::delete('/needs/{id}', [UserController::class, 'destroy'])->name('needs.destroy');
    });
});
