<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::factory()
            ->count(100)
            ->create();

        //Assign an answer to each question
        Question::all()->each(function($question) {
            $answers = QuestionAnswer::factory()->count(3)->make(['question_id' => $question->id]);

            // Randomly pick one of the answers to be the valid one
            $answers->random()->validity = 1;

            // Save all answers
            $question->answers()->saveMany($answers);
        });
    }
}
