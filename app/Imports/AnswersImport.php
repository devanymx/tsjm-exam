<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class AnswersImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            QuestionAnswer::create([
                'name' => $row[1],
                'answer' => $row[1],
                'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[1]), 0, 5)), '-'),
                'validity' => (bool)random_int(0, 1),
                'question_id' => $row[7],
            ]);
            QuestionAnswer::create([
                'name' => $row[2],
                'answer' => $row[2],
                'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[2]), 0, 5)), '-'),
                'validity' => (bool)random_int(0, 1),
                'question_id' => $row[7],
            ]);
            QuestionAnswer::create([
                'name' => $row[3],
                'answer' => $row[3],
                'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[3]), 0, 5)), '-'),
                'validity' => (bool)random_int(0, 1),
                'question_id' => $row[7],
            ]);
            QuestionAnswer::create([
                'name' => $row[4],
                'answer' => $row[4],
                'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[4]), 0, 5)), '-'),
                'validity' => (bool)random_int(0, 1),
                'question_id' => $row[7],
            ]);
        }
    }
}
