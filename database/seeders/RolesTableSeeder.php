<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Role::count() === 0) {
            Role::insert([
                ['name' => 'superAdmin'],
                ['name' => 'admin'],
                ['name' => 'student'],
                ['name' => 'teacher'],
                ['name' => 'hod'],
                ['name' => 'cod'],
                // Add more users here...
            ]);
        }
    }
}
