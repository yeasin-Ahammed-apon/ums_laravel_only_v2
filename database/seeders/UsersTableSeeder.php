<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Permission;
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
            $lastUser = User::where('role_id', 1)->orderBy('id', 'desc')->first();
            if ($lastUser === null) $lastUser = 0;
            else $lastUser = $lastUser->id;
            $lastUser = $lastUser + 1;
            $lastUser = strtoupper('superAdmin') . strval($lastUser);
            $user = new User();
                $user->name = 'Yeasin Ahammed Apon';
                $user->password = Hash::make('123456');
                $user->role_id = Role::where('name', 'superAdmin')->first()->id;
                $user->login_id = $lastUser;
                $user->image = 'superAdmin.png';
                $user->status = 1;
                $user->created_by = 1;
                $user->save();
                if ($user) {
                    $permission=new Permission();
                    $permission->user_id = $user->id;
                    $permission->sidebar = superAdminSidebarOption();
                    $permission->save();
                    $user->permission_id = $permission->id;
                    $user->save();
                }
        }
    }
}
