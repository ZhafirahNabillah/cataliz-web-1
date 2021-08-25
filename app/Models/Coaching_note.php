<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Coaching_note extends Model
{
  use HasFactory, LogsActivity;

  protected $fillable = ['subject', 'summary', 'attachment', 'send_to_mail', 'owner_id', 'agenda_detail_id'];

  //Log activity
  protected static $logAttributes = ['subject', 'summary', 'attachment', 'send_to_mail', 'owner_id', 'agenda_detail_id'];

  protected static $logName = 'Coaching Note';

  public function getDescriptionForEvent(string $eventName): string
  {
    return "This user has been {$eventName} data Coaching Note";
  }

  protected static $logOnlyDirty = true;
  //end Log Activity

  public function agenda_detail()
  {
    return $this->belongsTo('App\Models\Agenda_detail');
  }

  public function owner()
  {
    return $this->belongsTo('App\Models\Coach');
  }
}
