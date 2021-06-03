<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'question',
        'answers',
        'weight',
        'true_answer',
        'exam_id'
    ];

    protected $casts = [
        'answers' => 'array',
        'true_answer' => 'integer'
    ];

    public function topic()
    {
        return $this->belongsTo('App\Models\Topic');
    }

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam');
    }
}
