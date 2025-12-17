<?php

use App\Http\Controllers\CerticateController;
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


