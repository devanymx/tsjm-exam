<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'finished_at',
        'started_at',
        'time',
        'score',
        'uuid'
    ];

    public function user(){
        return $this->belongsTo(UserExam::class);
    }
}
