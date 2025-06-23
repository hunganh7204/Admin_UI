<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;


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

        $response = Http::post('http://14.225.207.221:6060/mobile/auth/log-in', [
            'username' => $username,
            'password' => $password,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (
                isset($data['code']) && $data['code'] === 0 &&
                isset($data['result']['authenticated']) && $data['result']['authenticated'] === true &&
                isset($data['result']['role']) && $data['result']['role'] === 'ADMIN'
            ) {
                // Chỉ cho phép đăng nhập nếu role là ADMIN
                Session::put('admin_logged_in', true);
                Session::put('admin_role', 'ADMIN'); // Lưu role nếu cần
                return redirect()->route('users.index');
            } else {
                return back()->with('error', 'Bạn không có quyền truy cập. Chỉ tài khoản ADMIN mới được phép đăng nhập.');
            }
        }

        return back()->with('error', 'Thông tin đăng nhập không đúng.');
    }


    public function logout()
    {
        Session::forget('admin_logged_in');
        return redirect()->route('login');
    }
}
