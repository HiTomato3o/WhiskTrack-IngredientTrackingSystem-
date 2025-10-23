<?php 

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    public function create(array $input)
    {
        Validator::make($input, [
            'full_name' => ['required', 'string', 'max:128', 'regex:/^[A-Za-z\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'in:Lecturer,Student'],
            'student_lecturer_admin_id' => ['required', 'string', 'max:24'],
            'password' => ['required', 'string', 'min:8', 'max:64', 'confirmed'],
        ])->validate();

        $role = Role::where('name', $input['role'])->first();

        return User::create([
            'full_name' => $input['full_name'],
            'email' => $input['email'],
            'role_id' => $role->id,
            'student_lecturer_admin_id' => $input['student_lecturer_admin_id'],
            'password' => Hash::make($input['password']),
            'is_approved' => false, // Self-registration needs approval
        ]);
    }
}