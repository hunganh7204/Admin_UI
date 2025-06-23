<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if ($username === 'admin' && $password === 'admin123') {
            Session::put('admin_logged_in', true);
            return redirect()->route('users.index');
        }

        return back()->with('error', 'Thông tin đăng nhập không đúng.');
    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        return redirect()->route('login');
    }
}
