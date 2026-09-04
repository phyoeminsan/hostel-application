<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\student;
use App\Models\major;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderBy('student_id', 'DESC')->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = Major::all();
        return view('admin.students.create', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        // dd($request);
        $students = Student::create($request->all());
        if ($request->hasFile('profile')) {
            $file_name = time() . '.' . $request->profile->extension();
            $upload = $request->profile->move(public_path('images/profiles/'), $file_name);
            
            if ($upload) {
                $students->profile = '/images/profiles/' . $file_name;
            }
        }
        $students->save();
        return redirect()->route('backend.students.index')
                 ->with('success', 'ကျောင်းသား/သူ အချက်အလက်ကို အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::find($id);
        $majors = Major::all();
        return view('admin.students.edit', compact('student','majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, string $id)
    {
        $student = Student::find($id);
        $student->update($request->all());

        //file upload
        if($request->hasFile('profile')){
            $file_name = time().'.'.$request->profile->extension();
            $upload = $request->profile->move(public_path('images/profiles/'),$file_name);
            if($upload){
                $student->profile = '/images/profiles/'.$file_name;
            }
        }

        $student->save();
        return redirect()->route('backend.students.index')
                         ->with('success', 'ကျောင်းသား/သူ အချက်အလက်ကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->route('backend.students.index')
                         ->with('success', 'ကျောင်းသား/သူ အချက်အလက်ကို အောင်မြင်စွာ ဖျက်ထုတ်ပြီးပါပြီ။');
    }

   public function login(Request $request)
    {
        $request->validate([
            'roll_no'  => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'roll_no.required'  => 'ကျောင်းသားနံပါတ် ဖြည့်သွင်းရန် လိုအပ်ပါသည်။',
            'password.required' => 'Password ဖြည့်သွင်းရန် လိုအပ်ပါသည်။',
            'password.min'      => 'လျှို့ဝှက်နံပါတ်သည် အနည်းဆုံး ၈ လုံး ရှိရပါမည်။',
        ]);

        $credentials = [
            'roll_no'  => $request->roll_no,
            'password' => $request->password,
        ];

        if (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->regenerateToken();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'auth_failed' => 'ကျောင်းသားနံပါတ် သို့မဟုတ် Password မှားယွင်းနေပါသည်။',
        ])->withInput($request->only('roll_no'));
    }
    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profile()
    {
        $student = Auth::guard('student')->user();
        return view('front.students.profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\Student $student */
        $student = Auth::guard('student')->user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'nrc' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'phone_no' => 'nullable|string|max:20',
            'address'  => 'nullable|string',
            'profile'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email|unique:students,email,' . $student->student_id . ',student_id',
            'password' =>   'nullable|string|min:6',
        ]);

        if ($request->hasFile('profile')) {
            $file_name = time() . '.' . $request->profile->extension();
            $request->profile->move(public_path('images/profiles/'), $file_name);
            $student->profile = '/images/profiles/' . $file_name;
        }

        $student->name     = $request->name;
        $student->nrc = $request->nrc;
        $student->date_of_birth = $request->date_of_birth;
        $student->phone_no = $request->phone_no;
        $student->address  = $request->address;
        $student->email = $request->filled('email') ? $request->email : $student->email;

        if($request->filled('password')){
            $student->password = Hash::make($request->password);
        }
        
        $student->save();

        return back()->with('success', 'သင်၏ အချက်အလက်များကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }
}
