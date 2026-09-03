<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\academic_year;
use App\Http\Requests\Academic_yearRequest;
use App\Http\Requests\Academic_yearUpdateRequest;

class Academic_yearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< HEAD
        $academic_years = Academic_year::orderBy('academic_year_id', 'ASC')->paginate(10);
=======
        $academic_years = Academic_year::orderBy('academic_year_id', 'DESC')->paginate(10);
>>>>>>> 62d1948 (feat: initial commit of local hostel application project)
        return view('admin.academic_years.index', compact('academic_years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.academic_years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Academic_yearRequest $request)
    {
        // dd($request);
        $academic_year = Academic_year::create($request->all());
        $academic_year->save();
        return redirect()->route('backend.academic_years.index')
                         ->with('success','ပညာသင်နှစ်သစ် အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
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
        $academic_year = Academic_year::find($id);
        return view('admin.academic_years.edit', compact('academic_year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Academic_yearUpdateRequest $request, string $id)
    {
        $academic_year = Academic_year::find($id);
        $academic_year->update($request->all());
        $academic_year->save();
        return redirect()->route('backend.academic_years.index', compact('academic_year'))
                         ->with('success', 'ပညာသင်နှစ် အချက်အလက်ကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $academic_year = Academic_year::find($id);
        $academic_year->delete(); 
        return redirect()->route('backend.academic_years.index')
                        ->with('success', 'ပညာသင်နှစ် အချက်အလက်ကို အောင်မြင်စွာ ဖျက်ထုတ်ပြီးပါပြီ။');
        }
}
