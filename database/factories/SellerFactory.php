<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->email,
            'password' => Hash::make('12345678'),
            'shop_name' => fake()->unique()->text(30),
            'shop_description' => fake()->text(350),
            'phone_number' => fake()->phoneNumber(),
        ];
    }
}
