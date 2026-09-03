<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\hostel_application;

class Hostel_applicationController extends Controller
{
    public function hostel_applications(){
<<<<<<< HEAD
        $hostel_applications = Hostel_application::orderBy('application_id', 'ASC')->paginate(13);
=======
        $hostel_applications = Hostel_application::orderBy('application_id', 'DESC')->paginate(13);
>>>>>>> 62d1948 (feat: initial commit of local hostel application project)
        return view('admin.hostel_applications.index', compact('hostel_applications'));
    }

    public function approved($id)
    {
        $hostel_application = hostel_application::findOrFail($id);
        $hostel_application->status = 'approved';
        $hostel_application->reason = null;
        $hostel_application->save();

        return redirect()->back()->with('success', 'Hostel Application ကို Approve ပြုလုပ်ပြီးပါပြီ။');
    }

    public function rejected(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $hostel_application = hostel_application::findOrFail($id);
        $hostel_application->status = 'rejected';
        $hostel_application->reason = $request->reason;
        $hostel_application->save();

        return redirect()->back()->with('success', 'Hostel Application ကို Reject ပြုလုပ်ပြီးပါပြီ။');
    }
}
