<?php

namespace Database\Seeders;

use App\Models\Admin;
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
                'password' => Hash::make('123456'),
                'role_id' => Role::where('name', 'superAdmin')->first()->id,
                'login_id' => 'SA0001',
                'image' => 'https://www.w3schools.com/howto/img_avatar.png',
                'permission_id' => 1,
                'status' => 1,
                'created_by' => 0
            ]);
            // Create admin user
            // create user
            $user  =  new User();
            $user->name = 'admin';
            $user->password = Hash::make('123456');
            $user->role_id = Role::where('name', 'admin')->first()->id;
            $user->login_id = 'A0001';
            $user->image = 'https://www.w3schools.com/howto/img_avatar.png';
            $user->permission_id = 1;
            $user->status = 1;
            $user->created_by = 1;
            $user->save();
            // create admin
            if ($user) {
                $admin  =  new Admin();
                $admin->user_id = $user->id;
                $admin->first_name = 'admin';
                $admin->last_name = 'admin';
                $admin->phone = '123456789';
                $admin->address = 'admin address';
                $admin->email = 'admin@admin.com';
                $admin->save();
            }
            $user  =  new User();
            $user->name = 'admin_offline';
            $user->password = Hash::make('123456');
            $user->role_id = Role::where('name', 'admin')->first()->id;
            $user->login_id = 'A0002';
            $user->image = 'https://www.w3schools.com/howto/img_avatar.png';
            $user->permission_id = 1;
            $user->status = 0;
            $user->created_by = 1;
            $user->save();
            // create admin
            if ($user) {
                $admin  =  new Admin();
                $admin->user_id = $user->id;
                $admin->first_name = 'admin';
                $admin->last_name = 'admin';
                $admin->phone = '123456789';
                $admin->address = 'admin address';
                $admin->email = 'admin1@admin.com';
                $admin->save();
            }


            // Create student user
            User::create([
                'name' => 'student',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('name', 'student')->first()->id,
                'login_id' => 'S0001',
                'image' => 'https://www.w3schools.com/howto/img_avatar.png',
                'permission_id' => 1,
                'status' => 1,
                'created_by' => 1
            ]);
            // Create teacher user
            User::create([
                'name' => 'teacher',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('name', 'teacher')->first()->id,
                'login_id' => 'T0001',
                'image' => 'https://www.w3schools.com/howto/img_avatar.png',
                'permission_id' => 1,
                'status' => 1,
                'created_by' => 1
            ]);
            // Create hod user
            User::create([
                'name' => 'hod',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('name', 'hod')->first()->id,
                'login_id' => 'H0001',
                'image' => 'https://www.w3schools.com/howto/img_avatar.png',
                'permission_id' => 1,
                'status' => 1,
                'created_by' => 1
            ]);
            // Create cod user
            User::create([
                'name' => 'cod',
                'password' => Hash::make('123456'),
                'role_id' => Role::where('name', 'cod')->first()->id,
                'login_id' => 'C0001',
                'image' => 'https://www.w3schools.com/howto/img_avatar.png',
                'permission_id' => 1,
                'status' => 1,
                'created_by' => 1
            ]);
        }
    }
}
