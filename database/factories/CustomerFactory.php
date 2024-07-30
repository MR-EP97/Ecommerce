<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
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
            'phone_number' => fake()->unique()->phoneNumber,
            'user_name' => fake()->unique()->userName,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'bio' => fake()->paragraph(),
            'profile_picture' => fake()->imageUrl,
        ];
    }
}
