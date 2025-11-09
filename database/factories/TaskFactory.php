<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerID = \Faker\Factory::create('id_ID');
        return [
            // nama tugas palsu
            'name' => $fakerID->words(3, true), 
            
            // poin acak
            'points' => $this->faker->randomElement([5, 10, 15]),
        ];
    }
}
