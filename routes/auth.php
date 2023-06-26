<?php

use App\Http\Controllers\Auth\AuthSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthSessionController::class, 'LoginIndex'])
                ->name('login');

    Route::post('login', [AuthSessionController::class, 'LoginStore'])
                ->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthSessionController::class, 'destroy'])
                ->name('logout');
});
