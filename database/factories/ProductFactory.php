<?php

namespace Database\Factories;

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
        return [
            'name' => $this->faker->name(),
            'gender' => 'male',
            'price' => 100000.05, 
            'image' => null,
            'description' => 'day la description', 
            'brand_id' => 1,
            'category_id' => 1,
        ];
    }
}
