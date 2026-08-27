<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\payment;
use App\Models\hostel_application;
use App\Models\student_record;
use App\Models\student;
use App\Models\academic_year;

class PaymentController extends Controller
{
    public function payments()
    {
        $payments = Payment::with(['hostel_application.student_record.student'])->get();
        return view('admin.payments.index', compact('payments'));
    }

   public function details($id)
    {
        $payment = Payment::with([
            'hostel_application.student.year',
            'hostel_application.student.major',
            'hostel_application.student.academic_year',
            'hostel_application.hostel'
        ])->findOrFail($id);

        return view('admin.payments.details', compact('payment'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:paid,failed',
            'reason' => 'nullable|string|max:255',
        ]);

        $payment = Payment::where('payment_id', $id)->firstOrFail();
        
        // Status Update လုပ်မည်
        $payment->status = $request->status == 'paid' ? 'verified' : 'failed'; 
        if ($request->status == 'failed') {
            $payment->reason = $request->reason;
        }
        $payment->save();

        return redirect()->route('backend.payments')->with('success', 'Payment status updated successfully!');
    }
}
