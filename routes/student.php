<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\Student\LoginController;


Route::prefix('student')->group(callback: function () {
    Route::get('/login',function (){
        return Inertia::render('Auth/Student/Login');
    })->name('loginStudent');

    Route::post('/loginForm',[LoginController::class,'login'])->name('loginFormStudent');

    Route::middleware('auth:student')->group(function () {

        Route::get('/dashboard', function () {
            return Inertia::render('StudentDashboard/STDHome');
        })->name('STDHome');

        Route::get('/logout', [LoginController::class, 'logout'])->name('logoutStudent');

        // Profile Student
        Route::get('/profile', function () {
            return Inertia::render('Auth/Student/Profile');
        })->name('student.profile');

        Route::post('profile/update/{id}', [LoginController::class,'update'])->name('student.update.profile');
    });
});


