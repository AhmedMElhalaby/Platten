<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $Country = Country::inRandomOrder()->first();
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->phoneNumber(),
            'nickname' => $this->faker->name(),
            'country_id'=> $Country->id,
            'city_id'=> ($Country->cities()->inRandomOrder()->first())->id,
            'avatar'=> $this->faker->imageUrl(),
            'cover'=> $this->faker->imageUrl(),
            'password'=>Hash::make('123456'),
            'company_name'=>$this->faker->company(),
            'maroof_company_number'=>rand(10000000,99999999),
            'maroof_tax_number'=>rand(10000000,99999999),
            'address'=>$this->faker->address(),
            'address_alt'=>$this->faker->streetAddress(),
            'postcode'=>$this->faker->postcode()
        ];
    }
}
