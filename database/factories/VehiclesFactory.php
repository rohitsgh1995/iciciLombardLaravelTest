<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicles>
 */
class VehiclesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reg_num' => $this->faker->unique()->regexify('[A-Z]{10}[0-9]{5}'),
            'engine_num' => $this->faker->unique()->regexify('[A-Z]{10}[0-9]{3}'),
            'chassis_num' => $this->faker->unique()->regexify('[A-Z]{10}[0-9]{2}'),
            'vin_num' => $this->faker->unique()->regexify('[A-Z]{10}[0-9]{3}'),
        ];
    }
}
