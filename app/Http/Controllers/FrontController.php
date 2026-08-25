<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Hostel;
use App\Models\Student_record;
use App\Models\Hostel_application; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index(){
        $hostels = Hostel::orderBy('hostel_id')->paginate(3);
        return view('front.index', compact('hostels'));
    }

    public function hostels()
    {
        $hostels = Hostel::orderBy('hostel_id')->paginate(3);
        return view('front.hostels', compact('hostels'));
    }

    public function showApplyForm($id){

        $hostel = Hostel::find($id);

        // 1. Login ဝင်ထားသော Student ကို ရယူခြင်း
        $studentUser = Auth::guard('student')->user();
        $student = $studentUser->student_id ?? Auth::id();
        
        $student_record = Student_record::with(['student', 'academic_year', 'year'])
                    ->where('student_id', $student)
                    ->latest('record_id')
                    ->first();

        // 3. Gender ကို Student Record (သို့) Login ဝင်ထားသော Student ဆီမှ ယူမည်
        $studentGender = $student_record->student->gender ?? $studentUser->gender ?? null;

        // 4. Gender စစ်ဆေးခြင်း
        if ($studentGender && strtolower($hostel->gender) !== 'all') {
            if (strtolower(trim($studentGender)) !== strtolower(trim($hostel->gender))) {
                return redirect()->route('index')->with('error', 'ကျေးဇူးပြု၍ သင်၏ Gender နှင့် ကိုက်ညီသော အဆောင်ကိုသာ ရွေးချယ်လျှောက်ထားနိုင်ပါသည်။');
            }
        }

        return view('front.apply', compact('hostel', 'student_record'));
    }

    public function storeApplication(Request $request)
    {
        $request->validate([
            'hostel_id' => 'required',
            'date' => 'required|date',
        ]);

        $studentUser = Auth::guard('student')->user();
        $student = $studentUser->student_id ?? Auth::id();

        $student_record = Student_record::where('student_id', $student)
                            ->latest('record_id')
                            ->first();
        
        if (!$student_record) {
            return redirect()->back()->with('error', 'သင့်အတွက် ကျောင်းသား Record စာရင်း မရှိသေးပါ။');
        }

        $hostel_application = Hostel_application::create([
            'record_id' => $student_record->record_id,
            'hostel_id' => $request->hostel_id,
            'apply_date' => $request->date,
            'status' => 'pending',
        ]);

        return redirect()->route('index')->with('success', 'အဆောင်လျှောက်ထားခြင်း အောင်မြင်ပါသည်။ ကျောင်းဘက်ကနေမှ အတည်ပြုမည့်အချိန်ထိ ခေတ္တစောင့်ဆိုင်းပေးပါ။ ');
    }

     public function showPaymentForm($id)
    {
        $hostel_application = Hostel_application::find($id);

        $studentUser = Auth::guard('student')->user();
        $student = $studentUser->student_id ?? Auth::guard('student')->id();
        $student_record = Student_record::with(['student', 'academic_year', 'year'])
                ->where('student_id', $student)
                ->latest('record_id')
                ->first();

        return view('front.payments', compact('hostel_application', 'student_record'));
    }
}
