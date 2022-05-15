<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;

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
    public function definition()
    {
      return [
          'title' => $this->faker->sentence(),
          'body' => $this->faker->paragraphs($nb = 3, $asText = true),
          'author_id' => $this->faker->randomElement(Author::pluck('id')),
          'created_at' => NOW()
      ];
    }
}
