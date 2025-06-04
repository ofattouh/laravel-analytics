<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Create DB seed/test entries for Post table using faker library
            'title'       => $this->faker->word(),
            'text'        => $this->faker->paragraphs(asText: true),
            'category_id' => 12, // default value for foreign key relation between category and posts (fallback for DB integrity error)
        ];
    }
}

/*

    'content' => $this->faker->words(asText: true),
*/
