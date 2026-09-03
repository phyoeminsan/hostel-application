<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\student_record;
use App\Models\academic_year;
use App\Models\year;
use App\Models\student;
use App\Models\major;
use App\Http\Requests\Student_recordRequest;
use App\Http\Requests\Student_recordUpdateRequest;

class Student_recordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
<<<<<<< HEAD
        $student_records = Student_record::orderBy('record_id', 'ASC');
=======
        $student_records = Student_record::orderBy('record_id', 'DESC');
>>>>>>> 62d1948 (feat: initial commit of local hostel application project)

         if($request->has('year_id') && $request->year_id!=''){
            $student_records->where('year_id', $request->year_id);
        }

        $student_records = $student_records->paginate(10);

        return view('admin.student_records.index', compact('student_records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $academic_years = Academic_year::all();
        $years = Year::all();
        $students = Student::all();
        $majors = Major::all();
        return view('admin.student_records.create', compact('academic_years','years','students','majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Student_recordRequest $request)
    {
        // dd($request);
        $student_records = Student_record::create($request->all());
        $student_records->save();
        return redirect()->route('backend.student_records.index', ['year_id' => $request->year_id])
                         ->with('success', 'ကျောင်းသား မှတ်တမ်းကို အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
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
        $student_record = Student_record::find($id);
        $academic_years = Academic_year::all();
        $years = Year::all();
        $students = Student::all();
        $majors = Major::all();
        return view('admin.student_records.edit', compact('student_record','academic_years','years','students','majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Student_recordUpdateRequest $request, string $id)
    {
        $student_record = Student_record::find($id);
        $student_record->update($request->all());
        $student_record->save();
        return redirect()->route('backend.student_records.index', ['year_id' => $request->year_id])
                         ->with('success', 'ကျောင်းသား မှတ်တမ်းကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student_record = Student_record::find($id);
        $student_record->delete();
        return redirect()->route('backend.student_records.index')
                         ->with('success', 'ကျောင်းသား မှတ်တမ်းကို အောင်မြင်စွာ ဖျက်ထုတ်ပြီးပါပြီ။');
    }
}
