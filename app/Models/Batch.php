<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Batch extends Model
{
  use HasFactory, LogsActivity;

  protected $fillable = [
    'program_id',
    'batch_number',
    'start_date',
    'end_date',
    'status'
  ];

  //Log activity
  protected static $logAttributes = [
    'program_id',
    'batch_number',
    'start_date',
    'end_date',
    'status'
  ];

  protected static $logName = 'Batch';

  public function getDescriptionForEvent(string $eventName): string
  {
    return "This user has been {$eventName} data Batch";
  }

  protected static $logOnlyDirty = true;
  //end Log Activity

  public function program()
  {
    return $this->belongsTo('App\Models\Program');
  }

  public function clients()
  {
    return $this->hasMany('App\Models\Client');
  }

  public function graduates()
  {
    return $this->hasMany('App\Models\Graduate');
  }

  public function bookings()
  {
    return $this->hasMany('App\Models\Booking');
  }
}
