<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\year;
use App\Http\Requests\YearRequest;
use App\Http\Requests\YearUpdateRequest;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< HEAD
        $years = Year::orderBy('year_id')->paginate(10);
=======
        $years = Year::orderBy('year_id','DESC')->paginate(10);
>>>>>>> 62d1948 (feat: initial commit of local hostel application project)
        return view('admin.years.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(YearRequest $request)
    {
        // dd($request);
        $year = Year::create($request->all());
        $year->save();
        return redirect()->route('backend.years.index')
                 ->with('success', 'နှစ် အချက်အလက်ကို အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
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
        $year = Year::find($id);
        return view('admin.years.edit', compact('year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(YearUpdateRequest $request, string $id)
    {
        $year = Year::find($id);
        $year->update($request->all());
        $year->save();
        return redirect()->route('backend.years.index')
                 ->with('success', 'နှစ် အချက်အလက်ကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $year = Year::find($id);
        $year->delete();
        return redirect()->route('backend.years.index')
                     ->with('success', 'နှစ် အချက်အလက်ကို အောင်မြင်စွာ ဖျက်ထုတ်ပြီးပါပြီ။');
    }
}
