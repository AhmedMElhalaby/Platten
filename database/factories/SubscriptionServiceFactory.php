<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->sentence(),
            'subscription_id'=>rand(1,2),
            'color'=>$this->faker->hexColor(),
            'checked'=>$this->faker->boolean(),
        ];
    }
}
