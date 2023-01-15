<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'question' => fake()->sentence(),
            'slug' => fake()->slug()
        ];
    }
}
