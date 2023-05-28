<?php

namespace Database\Seeders;

use App\Models\DepartmentWaiver;
use Illuminate\Database\Seeder;

class DepartmentWaiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        if (DepartmentWaiver::count() === 0) {
            $educationInfos = [
                [
                    'department_id' => 1,
                    'level1' => 10,
                    'level2' => 20,
                    'level3' => 30,
                    'level4' => 50,
                    'level5' => 100,
                ],
                // Add more sample data as needed
            ];
            DepartmentWaiver::insert($educationInfos);
        }

    }
}
