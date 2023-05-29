<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GenderSeeder::class);
        $this->call(BloodGroupSeeder::class);
        $this->call(BoardSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(FacultySeeder::class);
        $this->call(DepartmentWaiverSeeder::class);
        $this->call(DeparmentSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);


        // \App\Models\User::factory(10)->create();
    }
}
