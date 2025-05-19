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
        Route::get('/dashboard', function () {return view('admin.dashboard');})->name('admin.dashboard');
        Route::get('/admin/pending-users', [AdminController::class, 'pendingUsers'])->name('admin.pendingUsers');
        Route::post('/admin/approve-user/{id}', [AdminController::class, 'approveUser'])->name('admin.approveUser');
        Route::post('/admin/reject-user/{id}', [AdminController::class, 'rejectUser'])->name('admin.rejectUser');
    });

    // user
    Route::middleware('role:user')->prefix('user')->group(function () {
        Route::get('/dashboard',[UserController::class,'showMeetingNote'])->name('user.dashboard');
        // meetings_users
        Route::get('/meeting-members/create', [UserController::class, 'create'])->name('meeting-members.create');

        Route::post('/meeting-members', [UserController::class, 'storeM'])->name('meeting-members.store');
        Route::get('/meeting-members', [UserController::class, 'indexM'])->name('meetings.index');
        Route::get('/meeting-members/{meetingMember}', [UserController::class, 'editM'])->name('meeting-members.edit');
        Route::patch('/meeting-members/{meetingMember}', [UserController::class, 'updateM'])->name('meeting-members.update');
        Route::delete('/meeting-members/{meetingMember}', [UserController::class, 'destroyM'])->name('meeting-members.destroy');
        Route::get('/meeting/report', [UserController::class, 'generateReport'])->name('meeting.report');
        // gestion needs

Route::get('/needs', [UserController::class, 'indexN'])->name('needs.index');
        Route::post('/needs', [UserController::class, 'storeNeeds'])->name('needs.store');
        Route::post('/needs/update/{id}', [UserController::class, 'updateN'])->name('needs.update');
        Route::delete('/needs/delete/{id}', [UserController::class, 'destroyN'])->name('needs.destroy');

// pdf


    //  Route::get('/mahdars/{mahdar}/pdf', [UserController::class, 'exportPdf'])
    //  ->name('mahdars.export-pdf');
     Route::get('/test-pdf-arabe', [UserController::class, 'generateArabicPDF'])->name('pdf');
     Route::get('/generate-arabic-pdf', [UserController::class, 'generateArabicPDF'])->name('p');

Route::get('/mahdars/{mahdar}/synthese', [UserController::class, 'synthese'])
     ->name('mahdars.synthese');
     Route::get('/test-pdf-arabe', [UserController::class, 'generateArabicPDF'])->name('pdf');
    });
});
