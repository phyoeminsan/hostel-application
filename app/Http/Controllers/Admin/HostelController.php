<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\hostel;
use App\Http\Requests\HostelRequest;
use App\Http\Requests\HostelUpdateRequest;

class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hostels = Hostel::orderBy('hostel_id', 'ASC')->paginate(10);
        return view('admin.hostels.index', compact('hostels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hostels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HostelRequest $request)
    {
        // dd($request);
        $hostels = Hostel::create($request->all());
        $hostels->save();
        return redirect()->route('backend.hostels.index')
                 ->with('success', 'အဆောင် အချက်အလက်ကို အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
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
        $hostel = Hostel::find($id);
        return view('admin.hostels.edit', compact('hostel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HostelUpdateRequest $request, string $id)
    {
        $hostel = Hostel::find($id);
        $hostel->update($request->all());
        $hostel->save();
        return redirect()->route('backend.hostels.index')
                         ->with('success', 'အဆောင် အချက်အလက်ကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hostel = Hostel::find($id);
        $hostel->delete();
        return redirect()->route('backend.hostels.index')
                         ->with('success', 'အဆောင် အချက်အလက်ကို အောင်မြင်စွာ ဖျက်ထုတ်ပြီးပါပြီ။');
    }
}
