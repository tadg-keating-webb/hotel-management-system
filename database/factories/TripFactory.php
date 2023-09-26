<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(30),
            'price' => fake()->randomNumber(3),
            'duration' => rand(1, 5),
            'description' => fake()->paragraph(),
            'long_description' => fake()->randomHtml(3),
            'images' => [fake()->image()],
        ];
    }

//    public function postableImage(): static
//    {
//        return $this->state(fn (array $attributes) => [
//            'image' => [fake()->image()],
//        ]);
//    }
}
