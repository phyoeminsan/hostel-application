<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'backend','as'=>'backend.'],function(){
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('academic_years', App\Http\Controllers\Admin\Academic_yearController::class);
    Route::resource('years', App\Http\Controllers\Admin\YearController::class);
    Route::resource('students', App\Http\Controllers\Admin\StudentController::class);
});
