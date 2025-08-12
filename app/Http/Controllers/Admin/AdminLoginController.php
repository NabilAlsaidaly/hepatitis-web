<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->Role_ID === 3) {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return back()->with('error', '🚫 الحساب غير مصرح له كأدمن.');
        }

        return back()->with('error', '❌ فشل في تسجيل الدخول، تحقق من البيانات.');
    }
}
