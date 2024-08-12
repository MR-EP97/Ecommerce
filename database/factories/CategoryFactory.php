<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $random = mt_rand(0, 10);
        if ($random > 40) {
            $parent_id = Category::query()->inRandomOrder()->value('id');
        } else {
            $parent_id = null;
        }
        return [
            'name' => $this->faker->word,
            'parent_id' => $parent_id,
            'description' => $this->faker->realText
        ];
    }
}
