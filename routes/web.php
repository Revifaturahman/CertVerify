<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CerticateController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\VerificationLogsController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CertificatePreviewController;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {

    if (!Auth::check()) {
        return view('welcome'); // landing page
    }

    return Auth::user()->role === 'admin'
        ? redirect('/certificate')
        : redirect('/verification');

});


Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/certificate', [CerticateController::class,'index']);

    Route::get('/certificate/template/{name}', function ($name) {
        return view('templateCertificate.' . $name);
    })->name('template.preview');

    Route::get(
        '/certificate/preview/{certificate}',
        [CertificatePreviewController::class, 'preview']
    )->name('certificate.preview');

    Route::get(
        '/certificate/pdf/{certificate}',
        [CertificatePreviewController::class, 'generatePdf']
    )->name('certificate.pdf');

    Route::resource('participant', ParticipantController::class);
});


Route::middleware(['auth', 'role:verifier'])->group(function () {
    Route::get('/verification', [VerificationLogsController::class, 'index'])
        ->name('verification.logs');

    Route::post('/verification', [VerificationLogsController::class, 'verify'])
        ->name('verification.verify');
});

Route::middleware('auth')->group(function () {

    Route::get('/profile', function () {
        return view('profile');
    });

});

