<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Board::count() === 0) {
            $divisions = ['Dhaka','Chittagong','Rajshahi','Khulna','Barisal','Sylhet','Rangpur','Mymensingh'];
            foreach ($divisions as $division) {
                $board = new Board();
                $board->name = $division;
                $board->save();
            }
        }
    }
}
