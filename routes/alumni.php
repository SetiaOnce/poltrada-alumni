<?php

use App\Http\Controllers\Alumni\DashboardAlumniController;
use App\Http\Controllers\Alumni\ProfileAlumniController;
use App\Http\Controllers\Alumni\SystemAlumniController;
use App\Http\Controllers\Login\LoginAlumniController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// for login alumni
Route::controller(LoginAlumniController::class)->group(function(){
    Route::get('/login_alumni', 'index');
    Route::get('/load_info_login_alumni', 'loadLoginInfo');
    Route::post('/request_login_alumni', 'login');
    Route::get('/app_alumni/logout', 'logout');
});
Route::group(['middleware' => 'auth'], function() {
    // App Admin Alumni
    Route::group(['prefix' => 'app_alumni'], function () {
        Route::get('/dashboard', function () {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            return view('alumni.index');
        });
        Route::get('/load_profile', [SystemAlumniController::class, 'loadProfile']);
        Route::get('/load_app_profile_site', [SystemAlumniController::class, 'loadProfileApp']);
        Route::get('/load_dashboard_profile', [DashboardAlumniController::class, 'loadProfile']);
        Route::get('/load_dashboard_tracer_study', [DashboardAlumniController::class, 'loadTracerStudy']);
        Route::post('/load_kartu_hasil_study', [DashboardAlumniController::class, 'kartuHasilStudy']);
        // profile alumni
        Route::controller(ProfileAlumniController::class)->group(function(){
            Route::get('/profile-alumni', 'index');
            Route::get('/ajax/load_profile_alumni', 'data');
            Route::post('/ajax/profile_alumni_update', 'update');
        });
    });
});