<?php

use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\DataAlumniController;
use App\Http\Controllers\Backend\KegiatanController;
use App\Http\Controllers\Backend\ProfileAppController;
use App\Http\Controllers\Backend\ReportTracerStudyController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\SelectController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return redirect()->back();
});
Route::controller(FrontendController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('/baca/{id}/{slug}', 'detailKegiatan');
});
Route::group(['prefix' => 'front'], function () {
    Route::controller(LoginController::class)->group(function(){
        Route::get('/load_login_info', 'loadLoginInfo');
    });
    Route::controller(FrontendController::class)->group(function(){
        Route::get('/load_info_system', 'loadSystemInfo');
        Route::post('/ajax/load_data_alumni', 'dataAlumni');
        Route::get('/ajax/load_pie_programstudi', 'pieProgramStudi');
        Route::get('/ajax/load_maps_alumni', 'mapsAlumni');
        Route::post('/ajax/load_modal_alumni', 'modalALumni');
        Route::get('/ajax/cek_dataku', 'cekDataku');
        Route::get('/load_more_kegiatan', 'loadMoreKegiatan');
        Route::get('/load_other_kegiatan', 'otherKegiatan');
        Route::get('/load_populer_kegiatan', 'populerKegiatan');
    });
});
//  ===========>> SELECT START <<============== //
Route::group(['prefix' => 'select'], function () {
    Route::controller(SelectController::class)->group(function(){
        Route::get('/ajax_getprodi', 'loadProdi');
        Route::get('/ajax_getprovinsi', 'loadProvinsi');
        Route::get('/ajax_getkabupaten', 'loadKabupaten');
    });
});
//  ===========>> SELECT END <<============== //
//  ===========>> FOR LOGIN ADMIN <<============== //
Route::get('/reloadcaptcha', function () {
	return captcha_img();
});
Route::controller(LoginController::class)->group(function(){
    Route::get('/login', 'index');
    Route::post('/ajax_login', 'login');
});
Route::get('/logout', function () {
    Session::flush();
    return redirect('/'); 
});
//  ===========>> END LOGIN ADMIN<<============== //
// App Admin
Route::group(['prefix' => 'app_admin'], function () {
    Route::get('/dashboard', function () {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        if(!session()->get('login_akses')) { 
            return redirect('/login'); 
        } 
        return view('backend.index');
    });
    Route::get('/user_profile', function () {
        if(!session()->get('login_akses')) { 
            return redirect('/login'); 
        } 
        return view('backend.common.profile');
    });
    //  ===========>> CUMMON  <<============== //
    Route::get('/load_user_profile', [CommonController::class, 'loaduserProfile']);
    Route::get('/load_profile', [CommonController::class, 'loadProfile']);
    Route::get('/load_app_profile_site', [CommonController::class, 'loadProfileApp']);
    Route::get('/ajax_get_count_widget', [CommonController::class, 'widgetCount']);
    //  ===========>> END COMMON <<============== //  
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/profileapps', [ProfileAppController::class, 'index']);
        Route::controller(ProfileAppController::class)->group(function(){
            Route::get('/load_profileapps', 'loadProfileApp');
            Route::post('/profileapps_update', 'profileAppUpdate');
        });
        Route::get('/banner', [BannerController::class, 'index']);
    });
    Route::get('/data-alumni', [DataAlumniController::class, 'index']);
    Route::get('/report_tracer_study', [ReportTracerStudyController::class, 'index']);
    Route::get('/kegiatan', [KegiatanController::class, 'index']);
});
// for setting banner
Route::controller(BannerController::class)->group(function(){
    Route::get('/ajax/load_banner', 'data');
    Route::post('/ajax/banner_update', 'update');
});
// for manage kegiatan alumni
Route::controller(KegiatanController::class)->group(function(){
    Route::post('/ajax/load_kegiatan', 'data');
    Route::get('/ajax/kegiatan_edit', 'edit');
    Route::post('/ajax/kegiatan_save', 'store');
    Route::post('/ajax/kegiatan_update', 'update');
    Route::post('/ajax/kegiatan_destroy', 'kegiatanDestroy');
    Route::post('/ajax/kegiatan_update_status', 'updateStatus');
    Route::post('/ajax/ajax_get_kegiatan_album', 'loadGaleri');
    Route::post('/ajax/kegiatan_album_save', 'saveFoto');
    Route::post('/ajax/kegiatan_album_destroy', 'fotoDestroy');
});
// for manage report tracer study
Route::controller(ReportTracerStudyController::class)->group(function(){
    Route::post('/ajax/load_report_tracer_study', 'data');
    Route::get('/ajax/load_detail_info_tracer_study', 'detailInfo');
    Route::post('/ajax/load_peserta_report_tracer_study', 'pesertaTracer');
});
// for manage data alumni
Route::controller(DataAlumniController::class)->group(function(){
    Route::post('/ajax/load_data_alumni', 'data');
    Route::post('/ajax/data_alumni_sincronisasi', 'sincronisasi');
});

require __DIR__.'/alumni.php';