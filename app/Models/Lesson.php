<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Lesson extends Model
{
  use HasFactory, LogsActivity;

  protected $fillable = [
    'lesson_name',
    'video',
    'sub_topic_id'
  ];

  //Log activity
  protected static $logAttributes = [
    'lesson_name',
    'video',
    'sub_topic_id'
  ];

  protected static $logName = 'Lesson';

  public function getDescriptionForEvent(string $eventName): string
  {
    return "This user has been {$eventName} data Lesson";
  }

  protected static $logOnlyDirty = true;
  //end Log Activity

  public function sub_topic()
  {
    return $this->belongsTo('App\Models\Sub_topic');
  }

  public function meeting()
  {
    return $this->hasOne('App\Models\Training_meeting', 'lesson_id');
  }

  public function lesson_histories()
  {
    return $this->hasMany('App\Models\Lesson_history', 'lesson_id');
  }
}
