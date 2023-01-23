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
            if($row[1] != null){
                $val1 = false;
                if(1 == $row[5])$val1=true;
                QuestionAnswer::create([
                    'name' => $row[1],
                    'answer' => $row[1],
                    'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[1]), 0, 10)).$row[7], '-'),
                    'validity' => $val1,
                    'question_id' => $row[7],
                ]);
                $val2 = false;
                if(2 == $row[5])$val2=true;
                QuestionAnswer::create([
                    'name' => $row[2],
                    'answer' => $row[2],
                    'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[2]), 0, 10)).$row[7], '-'),
                    'validity' => $val2,
                    'question_id' => $row[7],
                ]);
                $val3 = false;
                if(3 == $row[5])$val3=true;
                QuestionAnswer::create([
                    'name' => $row[3],
                    'answer' => $row[3],
                    'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[3]), 0, 10)).$row[7], '-'),
                    'validity' => $val3,
                    'question_id' => $row[7],
                ]);
                $val4 = false;
                if(4 == $row[5])$val4=true;
                QuestionAnswer::create([
                    'name' => $row[4],
                    'answer' => $row[4],
                    'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[4]), 0, 10)).$row[7], '-'),
                    'validity' => $val4,
                    'question_id' => $row[7],
                ]);
            }
        }
    }
}
