<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Agenda_detail extends Model
{
  use HasFactory, LogsActivity;

  protected $fillable = ['agenda_id', 'session_name', 'topic', 'date', 'time', 'media', 'media_url', 'duration', 'status'];

  //Log activity
  protected static $logAttributes = ['agenda_id', 'session_name', 'topic', 'date', 'time', 'media', 'media_url', 'duration', 'status'];

  protected static $logName = 'Agenda Detail';

  public function getDescriptionForEvent(string $eventName): string
  {
    return "This user has been {$eventName} data Agenda Detail";
  }

  protected static $logOnlyDirty = true;
  //end Log Activity

  // protected $dates = ['date'];

  public function agenda()
  {
    return $this->belongsTo('App\Models\Agenda');
  }

  public function note()
  {
    return $this->hasOne('App\Models\Coaching_note');
  }

  public function feedbacks()
  {
    return $this->hasMany('App\Models\Feedback');
  }
}
