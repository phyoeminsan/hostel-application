<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Hostel_allocation;
use App\Models\Payment;
use App\Models\Hostel_application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $activeBookings = Hostel_allocation::where('status', 'active')->count();
        $pendingPayments = Payment::where('status', 'pending')->count();
        
        $totalRevenue = Payment::whereIn('status', ['paid', 'verified'])->sum('amount');

        $recentActivities = Hostel_application::with([
                'student_record.student', 
                'hostel', 
                'room',
                'payment.hostel_allocation.room'
            ])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalStudents', 
            'activeBookings', 
            'pendingPayments', 
            'totalRevenue', 
            'recentActivities'
        ));
    }
}