<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CsrfTokenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Artisan;
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
        Route::group(['middleware' => 'check.super_admin.permission'], function () {
            Route::prefix("/groups")->group(function () {
                Route::get('/divisi', [DashboardController::class, 'divisi'])->name('divisi');
                Route::post('/add-divisi', [DashboardController::class, 'addDivisi'])->name('add.divisi');
                Route::get('/find-divisi', [DashboardController::class, 'findDivisi'])->name('find.divisi');
                Route::patch('/update-divisi', [DashboardController::class, 'updateDivisi'])->name('update.divisi');
                // catergory
                Route::get('/category', [DashboardController::class, 'category'])->name('category');
                Route::get('/list-category', [DashboardController::class, 'listCategory'])->name('list.category');
                Route::post('/add-category', [DashboardController::class, 'addCategory'])->name('add.category');
                Route::get('/find-category', [DashboardController::class, 'findCategory'])->name('find.category');
                Route::patch('/update-category', [DashboardController::class, 'updateCategory'])->name('update.category');
                Route::get('/toggle-category', [DashboardController::class, 'toggleActive'])->name('toggle.active');
                // permission
                Route::get('/permission', [DashboardController::class, 'permission'])->name('permission');
                Route::post('/add-permission', [DashboardController::class, 'addPermission'])->name('add.permission');
                Route::get('/filter-permission', [DashboardController::class, 'filter'])->name('filter.permission');
            });
        });
        Route::group(['middleware' => 'check.admin.permission'], function () {
            Route::prefix("/admin")->group(function () {
                Route::get('/', [AdminController::class, 'admin'])->name('admin');
                Route::get('/permission/{paramId}', [AdminController::class, 'adminPermission'])->name('admin-permission');
                Route::post('/permission/{paramId}/grant', [AdminController::class, 'grant'])->name('permission-grant');
                Route::post('/permission/{paramId}/revoke', [AdminController::class, 'revoke'])->name('permission-revoke');
                Route::get('/tambah-admin', [AdminController::class, 'addAdmin'])->name('tambah-admin');
                Route::post('/tambah-staff', [AdminController::class, 'addStaff'])->name('adminStaff.submit');
                Route::post('/tambah-spv', [AdminController::class, 'addSpv'])->name('adminSpv.submit');
                Route::post('/tambah-manager', [AdminController::class, 'addManager'])->name('adminManager.submit');
                Route::get('/edit-admin/{paramId}', [AdminController::class, 'editAdmin'])->name('edit-admin');
                Route::post('/edit-admin/{paramId}/tes', [AdminController::class, 'updateAdmin'])->name('edit-admin.submit');
            });
        });
    });

    Route::get('/fetch-permissions', function () {
        Artisan::call('fetch:permissions');
        return response()->json(['message' => 'Permissions fetched successfully.']);
    });

    Route::prefix("/user")->group(function () {
        Route::get('/', function () { return view('dashboard.user.user'); })->name('user');
    });

    Route::prefix("/koperasi")->group(function () {
        Route::get('/', function () { return view('dashboard.koperasi.koperasi'); })->name('koperasi');
    });

});

