<?php

namespace Database\Factories;

use App\Models\ProductTypeModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductTypeModelColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_type_model_id'=>(ProductTypeModel::inRandomOrder()->first())->id,
            'name'=>$this->faker->words(2,true),
            'color_hash'=>$this->faker->hexColor(),
        ];
    }
}
