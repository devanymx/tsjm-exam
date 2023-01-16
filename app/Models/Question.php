<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'question',
        'slug'
    ];

    public function questionAnswers(){
        return $this->hasMany(QuestionAnswer::class);
    }

    public function answers(){
        return $this->hasMany(QuestionAnswer::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
