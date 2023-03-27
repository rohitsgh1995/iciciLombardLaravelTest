<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CityTravelHistory>
 */
class CityTravelHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $from_date = $this->faker->dateTimeBetween('-2 year', '1 year');
        $from_date = Carbon::parse($from_date)->format("Y-m-d");
        $to_date = Carbon::createFromFormat('Y-m-d', $from_date)->addDays(rand(7, 15))->format("Y-m-d");

        return [
            'traveller_id' => $this->faker->numberBetween(1, 10),
            'city_id' => $this->faker->numberBetween(1, 10),
            'from_date' => $from_date,
            'to_date' => $to_date,
        ];
    }
}
