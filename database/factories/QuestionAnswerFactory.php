<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionAnswerFactory extends Factory
{
    protected $model = QuestionAnswer::class;

    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'answer' => fake()->words(3, true),
            'slug' => fake()->slug(),
            'validity' => 0,
            'question_id' => Question::factory()
        ];
    }
}
