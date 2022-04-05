<?php

namespace Database\Factories;

use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductTypeModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_type_id'=>(ProductType::inRandomOrder()->first())->id,
            'name'=>$this->faker->words(2,true),
        ];
    }
}
