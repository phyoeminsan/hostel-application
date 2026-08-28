<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\hostel_allocation;

class Hostel_allocationController extends Controller
{
    public function hostel_allocations(){
        $hostel_allocations = Hostel_allocation::orderBy('allocation_id')->get();
        return view('admin.hostel_allocations.index', compact('hostel_allocations'));
    }
}
