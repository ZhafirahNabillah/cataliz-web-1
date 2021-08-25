<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Exam_result extends Model
{
  use HasFactory, LogsActivity;

  protected $fillable = [
    'topic_id',
    'exam_id',
    'grade',
    'user_id',
    'attempt_start',
    'attempt_submit'
  ];

  //Log activity
  protected static $logAttributes = [
    'topic_id',
    'exam_id',
    'grade',
    'user_id',
    'attempt_start',
    'attempt_submit'
  ];

  protected static $logName = 'Exam Result';

  public function getDescriptionForEvent(string $eventName): string
  {
    return "This user has been {$eventName} data Exam Result";
  }

  protected static $logOnlyDirty = true;
  //end Log Activity

  public function topic()
  {
    return $this->belongsTo('App\Models\Topic');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function exam()
  {
    return $this->belongsTo('App\Models\Exam');
  }

  public function answers()
  {
    return $this->hasMany('App\Models\Answer', 'result_id');
  }

  public function training_feedbacks()
  {
    return $this->hasMany('App\Models\Training_feedback', 'result_id');
  }
}
