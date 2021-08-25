<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Exam extends Model
{
  use HasFactory, LogsActivity;

  protected $fillable = [
    'topic_id',
    'type',
    'duration',
    'owner_id'
  ];

  //Log activity
  protected static $logAttributes = [
    'topic_id',
    'type',
    'duration',
    'owner_id'
  ];

  protected static $logName = 'Exam';

  public function getDescriptionForEvent(string $eventName): string
  {
    return "This user has been {$eventName} data Exam";
  }

  protected static $logOnlyDirty = true;
  //end Log Activity

  public function topic()
  {
    return $this->belongsTo('App\Models\Topic');
  }

  public function owner()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function questions()
  {
    return $this->hasMany('App\Models\Question', 'exam_id');
  }

  public function results()
  {
    return $this->hasMany('App\Models\Exam_result', 'exam_id');
  }
}
