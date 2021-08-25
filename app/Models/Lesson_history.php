<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Lesson_history extends Model
{
  use HasFactory, LogsActivity;

  protected $fillable = [
    'user_id',
    'topic_id',
    'lesson_id'
  ];

  //Log activity
  protected static $logAttributes = [
    'user_id',
    'topic_id',
    'lesson_id'
  ];

  protected static $logName = 'Lesson History';

  public function getDescriptionForEvent(string $eventName): string
  {
    return "This user has been {$eventName} data Lesson History";
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

  public function lesson()
  {
    return $this->belongsTo('App\Models\Lesson');
  }
}
