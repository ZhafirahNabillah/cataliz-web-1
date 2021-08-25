<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Answer extends Model
{
  use HasFactory, LogsActivity;

  protected $fillable = [
    'exam_id',
    'question_id',
    'result_id',
    'answer'
  ];

  //Log activity
  protected static $logAttributes = [
    'exam_id',
    'question_id',
    'result_id',
    'answer'
  ];

  protected static $logName = 'Answer';

  public function getDescriptionForEvent(string $eventName): string
  {
    return "This user has been {$eventName} data Answer";
  }

  protected static $logOnlyDirty = true;
  //end Log Activity

  public function exam()
  {
    return $this->belongsTo('App\Models\Exam');
  }

  public function result()
  {
    return $this->belongsTo('App\Models\Exam_result');
  }

  public function question()
  {
    return $this->belongsTo('App\Models\Question');
  }
}
