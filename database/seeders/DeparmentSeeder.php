<?php

namespace Database\Seeders;

use App\Models\Deparment;
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
            }
        }
    }
}
