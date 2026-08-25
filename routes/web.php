<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [App\Http\Controllers\FrontController::class, 'index'])->name('index');

Route::get('/hostels', [App\Http\Controllers\FrontController::class, 'hostels'])->name('hostels');

Route::get('/hostels/{id}/apply', [App\Http\Controllers\FrontController::class, 'showApplyForm'])->name('hostel.apply');

Route::post('/hostels/apply/store', [App\Http\Controllers\FrontController::class, 'storeApplication'])->name('hostels.apply.store');

Route::middleware(['auth:student'])->group(function () {
    Route::get('/hostel_applications/{id}/payment', [App\Http\Controllers\FrontController::class, 'showPaymentForm'])->name('hostels.payment');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\AdminLoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\AdminLoginController::class, 'logout'])->name('admin.logout');

});

Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');
Route::post('/login', [App\Http\Controllers\Admin\StudentController::class, 'login']);
Route::post('/student/logout', [App\Http\Controllers\Admin\StudentController::class, 'logout'])->name('student.logout');

Route::middleware(['auth:student'])->group(function () {
    Route::post('/student/logout', [App\Http\Controllers\Admin\StudentController::class, 'logout'])->name('student.logout');
    Route::get('/student/profile', [App\Http\Controllers\Admin\StudentController::class, 'profile'])->name('student.profile');
    Route::post('/student/profile/update', [App\Http\Controllers\Admin\StudentController::class, 'updateProfile'])->name('student.profile.update');

});

Route::group(['prefix' => 'backend','as' => 'backend.','middleware' => ['auth:admin']],function(){
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('academic_years', App\Http\Controllers\Admin\Academic_yearController::class);
    Route::resource('years', App\Http\Controllers\Admin\YearController::class);
    Route::resource('majors', App\Http\Controllers\Admin\MajorController::class);
    Route::resource('students', App\Http\Controllers\Admin\StudentController::class);
    Route::resource('student_records', App\Http\Controllers\Admin\Student_recordController::class);
    Route::resource('hostels', App\Http\Controllers\Admin\HostelController::class);
    Route::resource('rooms', App\Http\Controllers\Admin\RoomController::class);

    Route::get('hostel_applications', [App\Http\Controllers\Admin\Hostel_applicationController::class, 'hostel_applications'])->name('hostel_applications');

    Route::post('hostel_applications/{id}/approved', [App\Http\Controllers\Admin\Hostel_applicationController::class, 'approved'])->name('hostel_applications.approved');
    Route::post('hostel_applications/{id}/rejected', [App\Http\Controllers\Admin\Hostel_applicationController::class, 'rejected'])->name('hostel_applications.rejected');
});
