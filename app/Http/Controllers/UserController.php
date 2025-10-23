<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->where('is_approved', true);

        if ($request->filled('role')) {
            $query->whereHas('role', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $users = $query->with('role')->paginate(15);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:128',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'student_lecturer_admin_id' => 'nullable|string|max:24',
            'password' => 'required|string|min:8|max:64|confirmed',
        ]);

        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'student_lecturer_admin_id' => $request->student_lecturer_admin_id,
            'password' => Hash::make($request->password),
            'is_approved' => true,
        ]);
        return redirect()->route('users.index')->with('success', 'User added successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User removed.');
    }

    public function edit(User $user)
    {
        $roles = \App\Models\Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'full_name' => 'required|string|max:128',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'student_lecturer_admin_id' => 'nullable|string|max:24',
            'password' => 'nullable|string|min:8|max:64|confirmed',
    ]);

        $data = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'student_lecturer_admin_id' => $request->student_lecturer_admin_id,
    ];

        if ($request->filled('password')) {
         $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
    }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }   
}