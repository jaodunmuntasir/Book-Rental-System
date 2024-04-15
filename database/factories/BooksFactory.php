<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Books>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'release_date' => $this->faker->date(),
            'pages' => $this->faker->numberBetween(100, 1000),
            'isbn' => $this->faker->isbn13(),
            'description' => $this->faker->paragraph(),
            'genres' => $this->faker->words(3, true),
            'in_stock' => $this->faker->numberBetween(0, 50),
        ];
    }
}
