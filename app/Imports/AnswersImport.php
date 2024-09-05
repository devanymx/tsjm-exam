<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Monolog\Handler\IFTTTHandler;

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
            if ($row[0] == 'ANSWER 1') {
                continue;
            }

            if($row[5] != null){
                $types = [
                    'penal' => '1',
                    'civil' => '2',
                    'extincion' => '3'
                ];

                $question = Question::create([
                    'name' => $row[5],
                    'question' => $row[5],
                    'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[5]), 0, 10)), '-'),
                    'type' => $types[$row[6]]
                ]);


                if ($row[0] != null) {
                    $val1 = false;
                    if($row[4] == 1)$val1=true;
                    QuestionAnswer::create([
                        'name' => $row[0],
                        'answer' => $row[0],
                        'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[0]), 0, 10)).$question->id, '-'),
                        'validity' => $val1,
                        'question_id' => $question->id,
                    ]);
                }

                if ($row[1] != null) {
                    $val2 = false;
                    if($row[4] == 2)$val2=true;
                    QuestionAnswer::create([
                        'name' => $row[1],
                        'answer' => $row[1],
                        'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[1]), 0, 10)).$question->id, '-'),
                        'validity' => $val2,
                        'question_id' => $question->id,
                    ]);
                }

                if ($row[2] != null) {
                    $val3 = false;
                    if($row[4] == 3)$val3=true;
                    QuestionAnswer::create([
                        'name' => $row[2],
                        'answer' => $row[2],
                        'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[2]), 0, 10)).$question->id, '-'),
                        'validity' => $val3,
                        'question_id' => $question->id,
                    ]);
                }

                if ($row[3] != null) {
                    $val4 = false;
                    if($row[4] == 4)$val4=true;
                    QuestionAnswer::create([
                        'name' => $row[3],
                        'answer' => $row[3],
                        'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[3]), 0, 10)).$question->id, '-'),
                        'validity' => $val4,
                        'question_id' => $question->id,
                    ]);
                }
            }
        }
    }
}
