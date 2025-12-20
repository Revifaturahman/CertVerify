<?php

use App\Http\Controllers\CerticateController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\CertificatePreviewController;
use App\Http\Controllers\VerificationLogsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/certificate', [CerticateController::class,'index']);

Route::get('/participant', function () {
    return view('participant');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/certificate/template/{name}', function ($name) {
    return view('templateCertificate.' . $name);
})->name('template.preview');

Route::resource('participant', ParticipantController::class);

Route::get(
    '/certificate/preview/{certificate}',
    [CertificatePreviewController::class, 'preview']
)->name('certificate.preview');


Route::get('/certificate/pdf/{certificate}',
    [CertificatePreviewController::class, 'generatePdf']
)->name('certificate.pdf');

Route::get('/verification', [VerificationLogsController::class, 'index'])->name('verification.logs');
Route::post('/verification', [VerificationLogsController::class, 'verify'])->name('verification.verify');
