<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ProductType;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cost = $this->faker->numberBetween(100,100000);
        $profit = $this->faker->numberBetween(1,100);
        $discount = $this->faker->numberBetween(1,30);
        $price = $cost + ($cost*$profit/100);
        $sell_price = $price - ($price*$discount/100);
        $Category = Category::inRandomOrder()->first();
        $SubCategory = $Category->sub_categories()->inRandomOrder()->first();
        $Brand = $SubCategory->brands()->inRandomOrder()->first();
        $ProductType = ProductType::where('sub_category_id',$SubCategory->id)->where('brand_id',$Brand->id)->inRandomOrder()->first();
        $ProductTypeModel = $ProductType->products_types_models()->inRandomOrder()->first();
        $ProductTypeModelColor = $ProductTypeModel->products_types_models_colors()->inRandomOrder()->first();
        $ProductTypeModelSize = $ProductTypeModel->products_types_models_sizes()->inRandomOrder()->first();
        return [
            'vendor_id' => (Vendor::inRandomOrder()->first())->id,
            'category_id' => $Category->id,
            'sub_category_id' => $SubCategory->id,
            'brand_id' => $Brand->id,
            'product_type_id' => $ProductType->id,
            'product_type_model_id' => $ProductTypeModel->id,
            'product_type_model_color_id' => $ProductTypeModelColor?$ProductTypeModelColor->id:null,
            'product_type_model_size_id' => $ProductTypeModelSize?$ProductTypeModelSize->id:null,
            'cost_price' => $cost,
            'profit_rate' => $profit,
            'discount' => $discount,
            'sell_price' => $sell_price,
            'product_type' => rand(1,2)
        ];
    }
}
