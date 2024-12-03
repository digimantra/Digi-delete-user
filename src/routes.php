<?php

use Illuminate\Support\Facades\Route;
use AppDigiDelete\AccountDeletion\Http\Controllers\AccountController;

Route::middleware('web')->group(function(){
    
    Route::post('/account/delete/request', [AccountController::class, 'requestDeletion']);
Route::post('/account/delete/confirm', [AccountController::class, 'confirmDeletion']);
Route::post('/account/delete/resend', [AccountController::class, 'resendOtp']);

Route::get('/request-otp', function () { 
    return view('digi_deleteUser::otp_request'); 
})->name('otp.request.form'); 

Route::post('/request-otp', [AccountController::class, 'requestDeletion'])->name('otp.request');
Route::post('/request-otp/resend', [AccountController::class, 'resendOtp'])->name('otp.resend');

Route::get('/confirm-otp', function () {
    return view('digi_deleteUser::otp_confirm'); 
})->name('otp.confirm.form');
 
Route::post('/confirm-otp', [AccountController::class, 'confirmDeletion'])->name('otp.confirm');


});




