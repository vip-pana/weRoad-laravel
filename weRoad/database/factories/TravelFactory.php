<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Travel>
 */
class TravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->sentence();
        $slug =  Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            'description' => fake()->paragraph(),
            'numberOfDays' =>  rand(0, 15),
            'isPublic' => fake()->boolean(),
            'moods' => json_encode([
                'nature' => rand(0, 100),
                'relax' => rand(0, 100),
                'history' => rand(0, 100),
                'culture' => rand(0, 100),
                'party' => rand(0, 100),
            ])
        ];
    }
}
