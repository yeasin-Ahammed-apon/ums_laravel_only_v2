<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Program::count() === 0) {
            $variable = ["Undergraduate","Postgraduate"];
            foreach ($variable as $key => $value) {
                $program = new Program();
                $program->name = $value;
                $program->save();
            }
        }
    }
}
