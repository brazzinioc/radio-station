<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

use App\Models\User;

class RadioStationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();

        return [
            'name' => $this->faker->text(150),
            'website' => $this->faker->url,
            'email' => $this->faker->unique()->safeEmail(),
            'slogan' => $this->faker->text(50),
            'about' => $this->faker->text(500),
            'mission' => $this->faker->text(500),
            'vision' => $this->faker->text(500),
            'moral_principles' => $this->faker->text(100),
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ];
    }
}
