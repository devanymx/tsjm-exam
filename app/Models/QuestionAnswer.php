<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'answer',
        'slug',
        'validity',
        'question_id'
    ];

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('validity','question_id');
    }
}
