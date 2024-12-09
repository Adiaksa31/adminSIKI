<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CsrfTokenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/csrf-token', [CsrfTokenController::class, 'generateCsrfToken']);

Route::middleware(['check.useragent.ip'])->group(function () {

    Route::middleware(['guestApi'])->group(function (){
        Route::get('/', function () { return view('login'); })->name('login');
        Route::post('/masuk', [AuthController::class, 'login'])->name('login.submit');
        Route::get('/verifikasi/{verify_key}', [AuthController::class, 'showVerifikasi'])->name('verify-login');
        Route::post('/verifikasi/submit', [AuthController::class, 'verify'])->name('verify.submit');
        Route::post('/verifikasi/resend-otp', [AuthController::class, 'resendOtp'])->name('resendOtp');
    });

    Route::middleware(["authApi"])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::prefix("/dashboard")->group(function () {
            Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        });
        Route::prefix("/admin")->group(function () {
            Route::get('/', [AdminController::class, 'admin'])->name('admin');
            Route::get('/tambah-admin', [AdminController::class, 'addAdmin'])->name('tambah-admin');
            Route::post('/tambah-staff', [AdminController::class, 'addStaff'])->name('adminStaff.submit');
            Route::post('/tambah-spv', [AdminController::class, 'addSpv'])->name('adminSpv.submit');
            Route::post('/tambah-manager', [AdminController::class, 'addManager'])->name('adminManager.submit');
            Route::get('/edit-admin/{paramId}', [AdminController::class, 'editAdmin'])->name('edit-admin');
            Route::post('/edit-admin/{paramId}/tes', [AdminController::class, 'updateAdmin'])->name('edit-admin.submit');
        });
    });

    Route::prefix("/user")->group(function () {
        Route::get('/', function () { return view('dashboard.user.user'); })->name('user');
    });

    Route::prefix("/koperasi")->group(function () {
        Route::get('/', function () { return view('dashboard.koperasi.koperasi'); })->name('koperasi');
    });

});

