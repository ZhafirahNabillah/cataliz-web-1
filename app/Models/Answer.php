<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
      'exam_id',
      'question_id',
      'result_id',
      'answer'
    ];

    public function exam() {
      return $this->belongsTo('App\Models\Exam');
    }

    public function result() {
      return $this->belongsTo('App\Models\Exam_result');
    }

    public function question() {
      return $this->belongsTo('App\Models\Question');
    }
}
