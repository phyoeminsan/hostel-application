<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\major;
use App\Http\Requests\MajorRequest;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::orderBy('major_id', 'ASC')->paginate(10);
        return view('admin.majors.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.majors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MajorRequest $request)
    {
        // dd($request);
        $majors = Major::create($request->all());
        $majors->save();
        return redirect()->route('backend.majors.index')
                         ->with('success', 'မေဂျာ အချက်အလက်ကို အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
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
        $major = Major::find($id);
        return view('admin.majors.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $major = Major::find($id);
        $major->update($request->all());
        $major->save();
        return redirect()->route('backend.majors.index')
                         ->with('success', 'မေဂျာ အချက်အလက်ကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $major= Major::find($id);
        $major->delete();
        return redirect()->route('backend.majors.index')
                         ->with('success', 'မေဂျာ အချက်အလက်ကို အောင်မြင်စွာ ဖျက်ထုတ်ပြီးပါပြီ။');
    }
}
