<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Faculty::count() === 0) {
            $variable = ["FACULTY OF DESIGN & TECHNOLOGY","FACULTY OF FINE & PERFORMING ARTS","FACULTY OF MANAGEMENT & GENERAL STUDIES "];
            foreach ($variable as $key => $value) {
                $faculty = new Faculty();
                $faculty->name = $value;
                $faculty->save();
            }
        }
    }
}
