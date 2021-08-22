<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\TranscriptController;
use App\Http\Controllers\Front\CheckStudentController;
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
    return view('front.index');
});
Route::get('/pdf', [\App\Http\Controllers\HomeController::class, 'pdf'])->name('pdf');
Route::post('/checkQrCode', [CheckStudentController::class, 'checkQrCode'])->name('checkQrCode');
Route::get('/student_details/{id}', [CheckStudentController::class, 'afterQrCode'])->name('afterQrCode');
Route::post('/checkImageDetail', [CheckStudentController::class, 'checkImageDetail'])->name('checkImageDetail');


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

    Route::group(['prefix' => 'students'], function () {
        Route::get('/', [StudentController::class, 'listStudents'])->name('listStudents');
        Route::get('/create', [StudentController::class, 'submitStudent'])->name('submitStudent');
        Route::post('/store', [StudentController::class, 'storeStudent'])->name('storeStudent');
        Route::get('/fetch_students', [StudentController::class, 'fetchStudents'])->name('fetchStudents');
    });

    Route::group(['prefix' => 'certifications'], function () {
        Route::get('/', [CertificationController::class, 'listCertificates'])->name('listCertificates');
        Route::get('/create', [CertificationController::class, 'submitCertificate'])->name('submitCertificate');
        Route::post('/store', [CertificationController::class, 'storeCertificate'])->name('storeCertificate');
        Route::get('/fetch_certifications', [CertificationController::class, 'fetchCertification'])->name('fetchCertification');
        Route::get('/check_pdf/{id}', [CertificationController::class, 'checkPdf'])->name('checkPdf');
    });

    Route::group(['prefix' => 'transcripts'], function () {
        Route::get('/', [TranscriptController::class, 'listTranscripts'])->name('listTranscripts');
        Route::get('/create', [TranscriptController::class, 'submitTranscript'])->name('submitTranscript');
        Route::post('/store', [TranscriptController::class, 'storeTranscript'])->name('storeTranscript');
        Route::get('/fetch_transcripts', [TranscriptController::class, 'fetchTranscripts'])->name('fetchTranscripts');
        Route::get('/check_pdf_result/{id}', [TranscriptController::class, 'checkPdf'])->name('checkPdfResult');

    });
});

