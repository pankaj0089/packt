<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
      return [
          'name' => $this->faker->firstName().' '.$this->faker->lastName(),
          'email' => $this->faker->unique()->safeEmail(),
          'address_line1' => $this->faker->streetName,
          'address_line2' => $this->faker->streetAddress,
          'city' => $this->faker->city,
          'gender' => $this->faker->randomElement(['male', 'female']),
          'status' => $this->faker->randomElement([0,1]),
          'country_id' => $this->faker->randomElement(Country::pluck('id')),
          'created_at' => NOW()
      ];
    }
}
