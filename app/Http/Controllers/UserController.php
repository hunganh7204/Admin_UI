<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $departments = [
        1 => 'Công nghệ thông tin',
        2 => 'Kỹ thuật phần mềm',
        3 => 'Hệ thống thông tin',
    ];
    public function index()
    {
        return view("users.index", ["users" => User::paginate(15)]);
    }


    public function create()
    {
        return view('users.create', [
            'departments' => $this->departments
        ]);
    }



public function store(Request $request)
{
    
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'password' => 'required|string|min:6',
        'role' => 'required|in:teacher,student',
    ]);

    return redirect()->route('users.index')->with('success', 'Tạo tài khoản thành công ');
}


    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    public function edit(User $user)
    {
        $teacher = \DB::table('teacher')->where('user_id', $user->id)->first();
        $user->department_id = $teacher->department_id ?? null;

        return view('users.edit', [
            'user' => $user,
            'departments' => $this->departments
        ]);
    }



public function update(Request $request, User $user)
{
   
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'role' => 'required|in:teacher,student',
        'status' => 'required|in:Active,Inactive',
    ]);

    return redirect()->route('users.index')->with('success', 'Cập nhật tài khoản thành công');
}


    public function destroy(User $user)
    {
        $user->status = 'Inactive';
        $user->save();

        return redirect()->route('users.index')->with('success', 'Tài khoản đã được vô hiệu hóa.');
    }

    public function activate(User $user)
    {
        $user->update(['status' => 'Active']);
        return redirect()->route('users.index')->with('success', 'Tài khoản đã được kích hoạt lại');
    }
}

