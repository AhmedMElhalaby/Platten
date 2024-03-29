<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->country(),
            'flag'=>$this->faker->imageUrl(),
            'code'=>$this->faker->countryCode()
        ];
    }
}
