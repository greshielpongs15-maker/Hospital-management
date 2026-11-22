<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

// Guests only: logged-in users are redirected to /dashboard automatically
Route::middleware(['guest', 'nocache'])->group(function () {
    Route::view('/', 'welcome')->name('welcome');

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:30,1');

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->middleware(['once', 'throttle:10,1']);
});

// Logged-in only: guests are redirected to /login
Route::middleware(['auth', 'nocache'])->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('once')->group(function () {
        Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
        Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
        Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store');
    });
});
