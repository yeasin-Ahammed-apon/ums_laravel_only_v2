<?php

namespace Database\Seeders;

use App\Models\BatchWaiver;
use Illuminate\Database\Seeder;

class BatchWaiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (BatchWaiver::count() === 0) {
            $educationInfos = [
                [
                    'batch_id' => 1,
                    'level1' => 10,
                    'level2' => 20,
                    'level3' => 30,
                    'level4' => 50,
                    'level5' => 100,
                ],
                // Add more sample data as needed
            ];
            BatchWaiver::insert($educationInfos);
        }
    }
}
