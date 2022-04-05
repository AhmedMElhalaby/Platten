<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandSubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sub_category_id'=>(SubCategory::inRandomOrder()->first())->id,
            'brand_id'=>(Brand::inRandomOrder()->first())->id,
        ];
    }
}
