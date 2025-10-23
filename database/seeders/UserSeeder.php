<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Ensure roles are present
        $adminRole = Role::where('abbreviation', 'A')->first();
        $lecturerRole = Role::where('abbreviation', 'L')->first();
        $studentRole = Role::where('abbreviation', 'S')->first();

        // Admin User
        User::updateOrCreate([
            'email' => 'nurulainaanasrin5@gmail.com',
        ], [
            'full_name' => 'System Admin',
            'role_id' => $adminRole->id,
            'student_lecturer_admin_id' => 'ADMIN001',
            'password' => Hash::make('Admin@12345'),
            'is_approved' => true,
            'phone_number' => '0123456789',
            'email_verified_at' => now(),
            'last_login_at' => null,
        ]);

        // Lecturer User
        User::updateOrCreate([
            'email' => 'lecturer@whisktrack.test',
        ], [
            'full_name' => 'Jane Lecturer',
            'role_id' => $lecturerRole->id,
            'student_lecturer_admin_id' => 'LECT001',
            'password' => Hash::make('Lecturer@2025'),
            'is_approved' => true,
            'phone_number' => '0123456790',
            'email_verified_at' => now(),
            'last_login_at' => null,
        ]);

        // Student User
        User::updateOrCreate([
            'email' => 'student@whisktrack.test',
        ], [
            'full_name' => 'John Student',
            'role_id' => $studentRole->id,
            'student_lecturer_admin_id' => 'STUD001',
            'password' => Hash::make('Student@2025'),
            'is_approved' => true,
            'phone_number' => '0123456791',
            'email_verified_at' => now(),
            'last_login_at' => null,
        ]);
    }
}