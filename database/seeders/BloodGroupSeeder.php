<?php

namespace Database\Seeders;

use App\Models\BloodGroup;
use Illuminate\Database\Seeder;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (BloodGroup::count() === 0) {
            $bloodTypes = ['A+','A-','B+','B-','O+','O-','AB+','AB-'];
            foreach ($bloodTypes as $bloodType) {
                $bloodGroup = new BloodGroup();
                $bloodGroup->name = $bloodType;
                $bloodGroup->save();
            }
        }
    }
}
