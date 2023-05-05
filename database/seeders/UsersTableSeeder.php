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
                'image' => '1683221846-pngtree-businessman-user-avatar-wearing-suit-with-red-tie-png-image_5809521.png',
                'permission_id' => 1,
                'status' => 1,
                'created_by' => 0
            ]);
    }
    }
}
