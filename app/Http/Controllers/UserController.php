<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class UserController extends Controller
{
    public function index()
    {
         $response = Http::get('http://14.225.207.221:6060/mobile/users');

    if ($response->successful()) {
        $users = $response->json(); 

        return view('users.index', [
            'users' => $users
        ]);
    }

        return back()->with('error', 'Không thể lấy danh sách người dùng.');
    }


    public function create()
    {
        return view('users.create');
    }


public function store(Request $request)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'password' => 'required|string|min:8',
        'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'role' => 'required|in:teacher,student,admin',
        'status' => 'required|in:Active,Inactive',
    ]);

    $avatarUrl = '';
    if ($request->hasFile('avatar_file')) {
        $path = $request->file('avatar_file')->store('avatars', 'public'); 
        $avatarUrl = asset('storage/' . $path); 
    }

    $payload = [
        'username' => $validated['username'],
        'password' => $validated['password'],
        'role' => strtoupper($validated['role']), 
        'avatar_url' => $avatarUrl,
        'fullname' => $validated['full_name'],
        'status' => strtoupper($validated['status']), 
    ];


    $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ])->post('http://14.225.207.221:6060/mobile/users', $payload);

    if (!$response->successful()) {
        return back()->withInput()->with('error', $response->json()['message'] ?? 'Tạo tài khoản thất bại');
    }

    return redirect()->route('users.index')->with('success', 'Tạo tài khoản thành công');
}





    public function show($id)
    {
        $response = Http::get("http://14.225.207.221:6060/mobile/users/{$id}");

        if ($response->successful()) {
            $user = $response->json(); // mảng

            return view('users.show', compact('user'));
        }

        return back()->with('error', 'Không thể lấy thông tin người dùng.');
    }


    public function edit($id)
    {
        $response = Http::get("http://14.225.207.221:6060/mobile/users/{$id}");

        if ($response->successful()) {
            $user = $response->json(); // dạng mảng
            return view('users.edit', compact('user'));
        }

        return back()->with('error', 'Không thể lấy thông tin người dùng để sửa.');
    }



public function update(Request $request, $id)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'role' => 'required|in:teacher,student,admin',
        'status' => 'required|in:Active,Inactive',
    ]);

    // Xử lý upload ảnh nếu có
    $avatarUrl = $request->input('avatar_url') ?? '';
    if ($request->hasFile('avatar_file')) {
        $path = $request->file('avatar_file')->store('avatars', 'public');
        $avatarUrl = asset('storage/' . $path);
    }

    $payload = [
        'username' => $validated['username'],
        'fullname' => $validated['full_name'],
        'role' => strtoupper($validated['role']),
        'status' => strtoupper($validated['status']),
        'avatar_url' => $avatarUrl,
    ];

    $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ])->put("http://14.225.207.221:6060/mobile/users/{$id}", $payload);

    if (!$response->successful()) {
        return back()->withInput()->with('error', $response->json()['message'] ?? 'Cập nhật tài khoản thất bại');
    }

    return redirect()->route('users.index')->with('success', 'Cập nhật tài khoản thành công');
}



    public function destroy($id)
    {
        // 1. Lấy thông tin user
        $response = Http::get("http://14.225.207.221:6060/mobile/users/{$id}");
        if (!$response->successful()) {
            return back()->with('error', 'Không thể lấy thông tin người dùng.');
        }

        $user = $response->json();

        // 2. Gửi lại toàn bộ payload, chỉ thay đổi status
        $payload = [
            'username' => $user['username'],
            'fullname' => $user['fullname'],
            'role' => strtoupper($user['role']),
            'avatar_url' => $user['avatar_url'] ?? '',
            'status' => 'INACTIVE',
        ];

        $updateResponse = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->put("http://14.225.207.221:6060/mobile/users/{$id}", $payload);

        if (!$updateResponse->successful()) {
            return back()->with('error', 'Không thể vô hiệu hóa tài khoản.');
        }

        return redirect()->route('users.index')->with('success', 'Tài khoản đã được vô hiệu hóa.');
    }


    public function activate($id)
    {
        $response = Http::get("http://14.225.207.221:6060/mobile/users/{$id}");
        if (!$response->successful()) {
            return back()->with('error', 'Không thể lấy thông tin người dùng.');
        }

        $user = $response->json();

        $payload = [
            'username' => $user['username'],
            'fullname' => $user['fullname'],
            'role' => strtoupper($user['role']),
            'avatar_url' => $user['avatar_url'] ?? '',
            'status' => 'ACTIVE',
        ];

        $updateResponse = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->put("http://14.225.207.221:6060/mobile/users/{$id}", $payload);

        if (!$updateResponse->successful()) {
            return back()->with('error', 'Không thể kích hoạt tài khoản.');
        }

        return redirect()->route('users.index')->with('success', 'Tài khoản đã được kích hoạt lại.');
    }


}

