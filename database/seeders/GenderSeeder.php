<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Gender::count() === 0) {
            $variable = ["Male","Female"];
            foreach ($variable as $key => $value) {
                $gender = new Gender();
                $gender->name = $value;
                $gender->save();
            }
        }
    }
}
