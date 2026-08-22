<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\room;
use App\Models\hostel;
use App\Http\Requests\RoomRequest;
use App\Http\Requests\RoomUpdateRequest;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rooms = Room::orderBy('hostel_id','ASC');

        if($request->has('hostel_id') && $request->hostel_id!=''){
            $rooms->where('hostel_id', $request->hostel_id);
        }

        $rooms = $rooms->paginate(10);

        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hostels = Hostel::all();
        return view('admin.rooms.create', compact('hostels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {
        // dd($request);
        $rooms = Room::create($request->all());
        $rooms->save();
        return redirect()->route('backend.rooms.index', ['hostel_id' => $request->hostel_id])
                         ->with('success', 'အခန်း အချက်အလက်ကို အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
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
        $room = Room::find($id);
        $hostels = Hostel::all();
        return view('admin.rooms.edit', compact('room','hostels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomUpdateRequest $request, string $id)
    {
        $room = Room::find($id);
        $room->update($request->all());
        $room->save();
        return redirect()->route('backend.rooms.index', ['hostel_id' => $request->hostel_id])
                         ->with('success', 'အခန်း အချက်အလက်ကို အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $room = Room::find($id);
        $room->delete();
        return redirect()->route('backend.rooms.index', ['hostel_id' => $request->hostel_id])
                         ->with('success', 'အခန်း အချက်အလက်ကို အောင်မြင်စွာ ဖျက်ထုတ်ပြီးပါပြီ။');
    }
}
