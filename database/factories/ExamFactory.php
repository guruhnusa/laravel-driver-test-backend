<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'score_signs' => $this->faker->numberBetween(20, 100),
            'score_generic' => $this->faker->numberBetween(20, 100),
            'score_psychologist' => $this->faker->numberBetween(20, 100),
            'status_signs' => $this->faker->randomElement(['start', 'done']),
            'status_generic' => $this->faker->randomElement(['start', 'done']),
            'status_psychologist' => $this->faker->randomElement(['start', 'done']),
            'timer_signs' => $this->faker->numberBetween(1, 20),
            'timer_generic' => $this->faker->numberBetween(1, 20),
            'timer_psychologist' => $this->faker->numberBetween(1, 20),
            'result' => $this->faker->randomElement(['Passed', 'Failed']),
        ];
    }
}
