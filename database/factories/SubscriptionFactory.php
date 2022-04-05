<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->words(2,true),
            'description'=>$this->faker->sentence(9),
            'monthly_price'=>rand(10,200),
            'yearly_price'=>rand(200,1000),
        ];
    }
}
