<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\hostel_allocation;
use App\Models\payment;
use App\Models\room;
use Illuminate\Support\Facades\Auth;

class Hostel_allocationController extends Controller
{
    public function hostel_allocations(){
        $hostel_allocations = Hostel_allocation::with([
            'payment.hostel_application.student_record.student',        
            'payment.hostel_application.student_record.year', 
            'room.hostel'                         
        ])->orderBy('allocation_id','DESC')->paginate(13);
        return view('admin.hostel_allocations.index', compact('hostel_allocations'));
    }

    public function create(Request $request)
    {
        $payments = Payment::whereIn('status', ['paid', 'verified'])
            ->whereDoesntHave('hostel_allocation')
            ->with(['hostel_application.student_record.student', 'hostel_application.hostel'])
            ->get();

        $selectedPaymentId = $request->payment_id;
        $rooms = collect(); 

        // Student/Payment ကို ရွေးထားပါက အဆိုပါ Student ၏ Hostel ID ဖြင့် Condition စစ်မည်
        if ($selectedPaymentId) {
            $selectedPayment = $payments->firstWhere('payment_id', $selectedPaymentId);
            
            if ($selectedPayment && $selectedPayment->hostel_application) {
                $hostelId = $selectedPayment->hostel_application->hostel_id;
                
                // Room များနှင့် Active ဖြစ်နေသော Allocation အရေအတွက်ကို ဆွဲထုတ်ခြင်း
                $rooms = Room::where('hostel_id', $hostelId)
                    ->withCount(['hostel_allocations' => function($query) {
                        $query->where('status', 'active');
                    }])
                    ->get();
            }
        }

        return view('admin.hostel_allocations.create', compact('payments', 'rooms', 'selectedPaymentId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_id'  => 'required|exists:payments,payment_id',
            'room_id'     => 'required|exists:rooms,room_id',
            'allocation_date'  => 'required|date',
            'status'      => 'required|in:active,unactive',
            'description' => 'required|string',
        ]);

        Hostel_allocation::create([
        'payment_id'  => $validated['payment_id'],
        'room_id'     => $validated['room_id'],
        'allocation_date'  => $validated['allocation_date'],
        'status'      => $validated['status'],
        'description' => $validated['description'],
        ]);

        $room = Room::find($request->room_id);
        if ($room) {
            $room->update(['status' => 'Full']);
        }

        return redirect()->route('backend.hostel_allocations')
                 ->with('success', 'အဆောင်အခန်း နေရာချထားမှု အောင်မြင်စွာ သိမ်းဆည်းပြီးပါပြီ။');
    }

    // Status အား Active သို့ ပြောင်းလဲခြင်း
    public function active($id)
    {
        $hostel_allocation = Hostel_allocation::findOrFail($id);
        $hostel_allocation->status = 'active';
        $hostel_allocation->save();

        return redirect()->back()->with('success', 'Hostel Allocation ကို Active ပြုလုပ်ပြီးပါပြီ။');
    }

    // Status အား Unactive သို့ ပြောင်းလဲခြင်း
    public function unactive($id)
    {
        $hostel_allocation = Hostel_allocation::findOrFail($id);
        $hostel_allocation->status = 'unactive';
        $hostel_allocation->save();

        return redirect()->back()->with('success', 'Hostel Allocation ကို Unactive ပြုလုပ်ပြီးပါပြီ။');
    }
}
