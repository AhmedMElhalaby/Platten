<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Brand;
use App\Models\BrandSubCategory;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Faq;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductTypeModel;
use App\Models\ProductTypeModelColor;
use App\Models\ProductTypeModelSize;
use App\Models\SubCategory;
use App\Models\Subscription;
use App\Models\SubscriptionService;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::factory()->count(15)->create();
        Category::factory()->count(1)->create();
        SubCategory::factory()->count(1)->create();
        Brand::factory()->count(1)->create();
        BrandSubCategory::factory()->count(1)->create();
        Country::factory()->count(4)->create();
        City::factory()->count(18)->create();
        Faq::factory()->count(25)->create();
        Subscription::factory()->count(2)->create();
        SubscriptionService::factory()->count(18)->create();
        ProductType::factory()->count(3)->create();
        ProductTypeModel::factory()->count(19)->create();
        ProductTypeModelColor::factory()->count(18)->create();
        ProductTypeModelSize::factory()->count(25)->create();
        Vendor::factory()->count(1)->create();
        Product::factory()->count(14)->create();
    }
}
