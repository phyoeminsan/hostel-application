<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Hostel;
use App\Models\Student_record;
use App\Models\Payment;
use App\Models\Hostel_application; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\hostel_allocation;

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

    public function storePayment(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'amount'         => 'required|numeric|min:0',
            'payment_slip'   => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120',
            'transaction_no' => 'required|string|max:255',
            'payment_date'   => 'required|date',
        ]);

        $payment = Payment::firstOrNew(['application_id' => $id]);

        $payment->application_id = $id;
        $payment->payment_method        = $request->payment_method;
        $payment->amount                = $request->amount;
        $payment->transaction_no        = $request->transaction_no;
        $payment->payment_date          = $request->payment_date;
        $payment->status         = 'pending';

        if ($request->hasFile('payment_slip')) {
            if ($payment->payment_slip && file_exists(public_path($payment->payment_slip))) {
            unlink(public_path($payment->payment_slip));
            }

            $file_name = time() . '.' . $request->payment_slip->extension();
            $request->payment_slip->move(public_path('images/payment_slips/'), $file_name);
            $payment->payment_slip = '/images/payment_slips/' . $file_name;
        }

        $payment->save();

        return redirect()->back()->with('success', 'ငွေပေးချေမှု အချက်အလက်များ အောင်မြင်စွာ ပေးပို့ပြီးပါပြီ။ ကျောင်းဘက်ကနေ မှ စိစစ်ပြီး အဆောင်အခန်း နေရာ ချထားပေးမှု အခြေအနေအား ထပ်မံ အကြောင်းကြားပေးပါမည်။');
    }

    public function myAllocation()
    {
        // Login ဝင်ထားသော Student ၏ ID (သို့မဟုတ် Auth User ID) ကို ယူမည်
        $studentId = Auth::id(); // သို့မဟုတ် Auth::guard('student')->id() 

        // Login ဝင်ထားသည့် Student ၏ Allocation Data ကို ရှာမည်
        $hostel_allocation = Hostel_allocation::whereHas('payment.hostel_application.student_record', function ($q) use ($studentId) {
            $q->where('student_id', $studentId); // user_id အစား student_id ဟု ပြင်ထားပါသည်
        })
        ->with([
            'room.hostel', 
            'payment.hostel_application'
        ])
        ->latest()
        ->first();

        return view('front.students.my_allocation', compact('hostel_allocation'));
    }
}
