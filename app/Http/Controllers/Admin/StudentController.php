<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\student;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentUpdateRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderBy('student_id')->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students.create');
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
        return view('admin.students.edit', compact('student'));
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
}
