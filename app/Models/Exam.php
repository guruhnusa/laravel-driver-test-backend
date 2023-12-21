<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    //fillable
    protected $fillable = [
        'user_id',
        'score_signs',
        'score_generic',
        'score_psychologist',
        'status_signs',
        'status_generic',
        'status_psychologist',
        'timer_signs',
        'timer_generic',
        'timer_psychologist',
        'result',
    ];
}
