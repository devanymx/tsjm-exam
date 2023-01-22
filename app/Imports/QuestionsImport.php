<?php

namespace App\Imports;

use App\Models\Question;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;


class QuestionsImport implements ToCollection
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
            Question::create([
                'name' => $row[0],
                'question' => $row[0],
                'slug' => Str::slug(implode(' ', array_slice(explode(' ', $row[0]), 0, 5)), '-'),
                'type' => $row[8]
            ]);
        }
    }
}
