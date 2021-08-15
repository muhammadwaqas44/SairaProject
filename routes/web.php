<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CertificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//
//Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index']);
//Route::get('/pdfGenerate', [\App\Http\Controllers\HomeController::class, 'pdfGenerate']);

Route::get('/adminLogin', function () {
    if (Auth::check()) {
        return redirect()->route('adminDashboard');
    }
    return view('admin.login');
})->name('showAdminLogin');
Route::post('/adminLogin', [AuthController::class, 'login'])->name('adminLogin');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('adminDashboard');
    Route::post('/adminLogout', [AuthController::class, 'logout'])->name('adminLogout');

    Route::group(['prefix' => 'certifications'], function () {
        Route::get('/', [CertificationController::class, 'listCertificates'])->name('listCertificates');
        Route::get('/create', [CertificationController::class, 'submitCertificate'])->name('submitCertificate');
        Route::post('/store', [CertificationController::class, 'storeCertificate'])->name('storeCertificate');
        Route::get('/fetch_certifications', [CertificationController::class, 'fetchCertification'])->name('fetchCertification');
    });
});

