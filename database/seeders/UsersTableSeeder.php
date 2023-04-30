<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() === 0) {
            // Create superAdmin user
            User::create([
                'name' => 'superAdmin',
                'email' => 'superAdmin@superAdmin.com',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('name', 'superAdmin')->first()->id,
                'user_id' => 'SA0001',
                'permission_id'=>1
            ]);
            // Create admin user
            User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('name', 'admin')->first()->id,
                'user_id' => 'A0001',
                'permission_id'=>1

            ]);
            // Create student user
            User::create([
                'name' => 'student',
                'email' => 'student@student.com',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('name', 'student')->first()->id,
                'user_id' => 'S0001',
                'permission_id'=>1
            ]);
            // Create teacher user
            User::create([
                'name' => 'teacher',
                'email' => 'teacher@teacher.com',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('name', 'teacher')->first()->id,
                'user_id' => 'T0001',
                'permission_id'=>1
            ]);
            // Create hod user
            User::create([
                'name' => 'hod',
                'email' => 'hod@hod.com',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('name', 'hod')->first()->id,
                'user_id' => 'H0001',
                'permission_id'=>1
            ]);
            // Create cod user
            User::create([
                'name' => 'cod',
                'email' => 'cod@cod.com',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('name', 'cod')->first()->id,
                'user_id' => 'C0001',
                'permission_id'=>1
            ]);



        }
    }
}
