<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $Category = Category::inRandomOrder()->first();
        $SubCategory = $Category->sub_categories()->inRandomOrder()->first();
        $Brand = $SubCategory->brands()->inRandomOrder()->first();
        return [
            'category_id'=>$Category->id,
            'sub_category_id'=>$SubCategory->id,
            'brand_id'=>$Brand->id,
            'name'=>$this->faker->words(2,true),
        ];
    }
}
