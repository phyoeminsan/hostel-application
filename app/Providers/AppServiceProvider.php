<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Student_record;
use App\Models\Hostel_application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        View::composer('*', function ($view) {
            if (Auth::guard('student')->check()) {
                $studentId = Auth::guard('student')->user()->student_id;

                // Student ၏ နောက်ဆုံး တင်ထားသော Application ကို ဆွဲယူမည်
                $latestApplication = Hostel_application::whereHas('student_record', function ($q) use ($studentId) {
                    $q->where('student_id', $studentId);
                })->with(['hostel', 'payment'])
                  ->latest('application_id')
                  ->first();

                $view->with('userNotification', $latestApplication);
            }
        });
    }
}
