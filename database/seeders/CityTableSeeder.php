<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();
        
        $cities = array(
            array('city_name' => "Delhi"),
            array('city_name' => "Mumbai"),
            array('city_name' => "Kolkata"),
            array('city_name' => "Amritsar"),
            array('city_name' => "Jaipur"),
            array('city_name' => "Odisha"),
            array('city_name' => "Surat"),
            array('city_name' => "Goa"),
            array('city_name' => "Raipur"),
            array('city_name' => "Patna"),
        );

        DB::table('cities')->insert($cities);
    }
}
