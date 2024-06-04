<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



Route::get('/', function () {return view('index');})->name('front.index');
Route::post('/email-verify',[AuthController::class,'emailverify'])->name('email.verify');
Route::post('/otp-verify',[AuthController::class,'otpverify'])->name('otp.verify');


Route::group(['middleware'=>'AuthCheck'],function(){

    Route::get('/dashboard', function () {return view('dashboard');})->name('front.dashbaord');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');

});


