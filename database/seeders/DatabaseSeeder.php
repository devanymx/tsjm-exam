<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Question::factory(300)->has(
            QuestionAnswer::factory(4)
        )->create();

        $answers = QuestionAnswer::all()->unique('question_id')->random(100);
        $user = User::factory()->create(['email' => 'edreiccb@gmail.com']);
        $user->questionAnswers()->attach($answers);

        //Create administrators team
        $teamAdmin = Team::factory()->create(['name' => 'Administrators', 'personal_team' => false, 'user_id' => $user->id]);
        $user->current_team_id = $teamAdmin->id;
        $user->save();


        $answers = QuestionAnswer::all()->unique('question_id')->random(100);
        $user = User::factory()->create();
        $user->questionAnswers()->attach($answers);

        //Create user team
        $team = Team::factory()->create(['name' => 'Users', 'personal_team' => false, 'user_id' => $user->id]);
        $user->current_team_id = $team->id;
        $user->save();


        $answers = QuestionAnswer::all()->unique('question_id')->random(100);
        $user = User::factory()->create();
        $user->questionAnswers()->attach($answers);

    }
}
