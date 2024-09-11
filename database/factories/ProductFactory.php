<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'name' => Str::random(10),
            // 'short_description' => Str::random(45),
            // 'description' =>  Str::random(150),
            // 'price' => random_int(100, 1000), 
            'name' => $this->faker->name(),
            'short_description' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
