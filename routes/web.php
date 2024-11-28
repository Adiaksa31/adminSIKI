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
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
        Route::get('/verify-{verify_key}', function () { return view('verify-login'); })->name('verify-login');
        Route::post('/verify/submit', [AuthController::class, 'verify'])->name('verify.submit');
        Route::post('/verify/resend-otp', [AuthController::class, 'resendOtp'])->name('resendOtp');
    });

    Route::middleware(["authApi"])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::prefix("/dashboard")->group(function () {
            Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        });

        Route::prefix("/admin")->group(function () {
            Route::get('/', [AdminController::class, 'admin'])->name('admin');
            Route::get('/tambah-admin', function () { return view('dashboard.admin.create-admin'); })->name('tambah-admin');
            Route::post('/tambah-admin', [AdminController::class, 'addAdmin'])->name('admin.submit');
        });
    });



    Route::prefix("/user")->group(function () {
        Route::get('/', function () { return view('dashboard.user.user'); })->name('user');
    });

    Route::prefix("/koperasi")->group(function () {
        Route::get('/', function () { return view('dashboard.koperasi.koperasi'); })->name('koperasi');
    });

});

