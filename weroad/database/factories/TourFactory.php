<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Genera una data casuale per la data di inizio tra un mese fa e oggi
        $startDate = Carbon::now()->subMonth()->format('Y-m-d');

        // Genera una data casuale per la data di fine tra oggi e un mese
        $endDate = Carbon::now()->addMonth()->format('Y-m-d');

        return [
            'name' => fake()->name(),
            'startingDate' => $startDate,
            'endingDate' => $endDate,
            'price' => rand(100, 1000),
        ];
    }
}
