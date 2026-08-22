<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\hostel_application;

class Hostel_applicationController extends Controller
{
    public function hostel_applications(){
        $hostel_applications = Hostel_application::all();
        return view('admin.hostel_applications.index', compact('hostel_applications'));
    }
}
