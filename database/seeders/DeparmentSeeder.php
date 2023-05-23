<?php

namespace Database\Seeders;

use App\Models\Deparment;
use App\Models\DepartmentCourseFeeInfo;
use Illuminate\Database\Seeder;

class DeparmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Deparment::count() === 0) {
            $variable = [
                "B. A. (Hons) in Fashion Design & Technology",
                "B. A. (Hons) in Apparel Manufacturing Management & Technology",
                "B. A. (Hons) in Interior Architecture",
                "B. A. (Hons) (Evening) Interior Architecture for Diploma Holder",
                "B. A. (Hons) in Graphic Design & Multimedia",
                "Bachelor of Architecture",
                "B. Sc. (Hons) in Computer Science & Information Technology",
                "B. Sc. (Hons) in Computer Science & Engineering",
                "B. Sc. (Hons) (Evening) Computer Science & Engineering for Diploma Holders",
                "Bachelor of Music (Hons) in Rabindra, Nazrul, Classical",
                "Bachelor of Music (Hons) in Dance",
                "Bachelor of Fine Arts (Hons)",
                "Bachelor of Business Administration (BBA)",
                "B.A (Hons) in Bangla"
            ];
            foreach ($variable as $key => $value) {
                $deparment = new Deparment();
                $deparment->name = $value;
                $deparment->faculty_id = 1;
                $deparment->program_id = 1;
                $deparment->save();
                $departmentCourseFeeInfo = new DepartmentCourseFeeInfo();
            $departmentCourseFeeInfo->deparment_id = $deparment->id;
            $departmentCourseFeeInfo->duration_year = intval(4);
            $departmentCourseFeeInfo->duration_semester = intval(8);
            $departmentCourseFeeInfo->credit = intval(152);
            $departmentCourseFeeInfo->admission_fee = intval(20000);
            $departmentCourseFeeInfo->session_fee = intval(4500);
            $departmentCourseFeeInfo->per_credit_fee = intval(2985);
            $departmentCourseFeeInfo->total_fee = intval(509720);
            $departmentCourseFeeInfo->save();
            }
        }
    }
}
