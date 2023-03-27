<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TravellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('travellers')->delete();

        $travellers = array(
            array('traveller_name' => "Rohit"),
            array('traveller_name' => "Ritu"),
            array('traveller_name' => "Raju"),
            array('traveller_name' => "Rajesh"),
            array('traveller_name' => "Ravi"),
            array('traveller_name' => "Raja"),
            array('traveller_name' => "Ronit"),
            array('traveller_name' => "Rakesh"),
            array('traveller_name' => "Rishav"),
            array('traveller_name' => "Rani"),
        );

        DB::table('travellers')->insert($travellers);
    }
}
