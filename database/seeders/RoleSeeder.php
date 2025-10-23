<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name' => 'Admin', 'abbreviation' => 'A']);
        Role::firstOrCreate(['name' => 'Lecturer', 'abbreviation' => 'L']);
        Role::firstOrCreate(['name' => 'Student', 'abbreviation' => 'S']);
    }
}