<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // 1. အချက်အလက် မဖြည့်ခဲ့လျှင် (Warning Alert)
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string|min:8',
        ], [
            'email.required'    => 'Email သို့မဟုတ် Username ဖြည့်သွင်းရန် လိုအပ်ပါသည်။',
            'password.required' => 'Password ဖြည့်သွင်းရန် လိုအပ်ပါသည်။',
            'password.min'      => 'လျှို့ဝှက်နံပါတ်သည် အနည်းဆုံး ၈ လုံး ရှိရပါမည်။',
        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $request->email,
            'password' => $request->password,
        ];

        // 2. Login အောင်မြင်ပါက
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/backend');
        }

        // 3. အချက်အလက် မှားယွင်းခဲ့လျှင် (Error Alert)
        return back()->withErrors([
            'auth_failed' => 'Email/Username သို့မဟုတ် Password မှားယွင်းနေပါသည်။',
        ])->withInput($request->only('login'));
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
