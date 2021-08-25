<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Feedback extends Model
{
  use HasFactory, LogsActivity;

  protected $fillable = [
    'agenda_detail_id',
    'feedback',
    'attachment',
    'rating',
    'user_id',
    'from',
  ];

  //Log activity
  protected static $logAttributes = [
    'agenda_detail_id',
    'feedback',
    'attachment',
    'rating',
    'user_id',
    'from',
  ];

  protected static $logName = 'Feedback';

  public function getDescriptionForEvent(string $eventName): string
  {
    return "This user has been {$eventName} data Feedback";
  }

  protected static $logOnlyDirty = true;
  //end Log Activity

  public function agenda_detail()
  {
    return $this->belongsTo('App\Models\Agenda_detail');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }
}
