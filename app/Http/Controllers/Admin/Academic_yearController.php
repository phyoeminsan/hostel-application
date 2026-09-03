<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $academic_years = Academic_year::orderBy('academic_year_id', 'DESC')->paginate(10);
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
        $academic_year = Academic_year::create($request->validated());
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
        $academic_year = Academic_year::findOrFail($id);
        return view('admin.academic_years.edit', compact('academic_year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Academic_yearUpdateRequest $request, string $id)
    {
        $academic_year = Academic_year::findOrFail($id);
        $academic_year->update($request->validated());
        return redirect()->route('backend.academic_years.index', compact('academic_year'))
                         ->with('success', 'ပညာသင်နှစ် အချက်အလက်ကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $academic_year = Academic_year::findOrFail($id);
        $academic_year->delete(); 
        return redirect()->route('backend.academic_years.index')
                        ->with('success', 'ပညာသင်နှစ် အချက်အလက်ကို အောင်မြင်စွာ ဖျက်ထုတ်ပြီးပါပြီ။');
        }

    /**
     * ဖျက်ထားသော Data များကို သီးသန့်ကြည့်ရန် (Trash Page)
     */
    public function trash()
    {
        // onlyTrashed() သုံးပြီး ဖျက်ထားတဲ့ Data များကိုသာ ဆွဲထုတ်ပါသည်
        $academic_years = Academic_year::onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate(10);
        return view('admin.academic_years.trash', compact('academic_years'));
    }

    /**
     * ဖျက်ထားသော Data ကို မူလအတိုင်း ပြန်ဖော်ရန် (Restore)
     */
    public function restore(string $id)
    {
        $academic_year = Academic_year::onlyTrashed()->findOrFail($id);
        $academic_year->restore(); // deleted_at ကို NULL ပြန်လုပ်ပေးသည်

        return redirect()->route('backend.academic_years.trash')
                        ->with('success', 'ပညာသင်နှစ် အချက်အလက်ကို မူလအတိုင်း ပြန်လည်ဖော်ယူပြီးပါပြီ။');
    }

    /**
     * Database ထဲမှ အပြီးတိုင် ဖျက်ထုတ်ရန် (Permanent / Hard Delete)
     */
    public function forceDelete(string $id)
    {
        $academic_year = Academic_year::onlyTrashed()->findOrFail($id);
        $academic_year->forceDelete(); // Database ထဲမှ အပြီးတိုင် ဖျက်ပါသည်

        return redirect()->route('backend.academic_years.trash')
                        ->with('success', 'ပညာသင်နှစ် အချက်အလက်ကို အပြီးတိုင် ဖျက်ထုတ်ပြီးပါပြီ။');
    }
}
