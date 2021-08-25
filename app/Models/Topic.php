<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Topic extends Model
{
  use HasFactory, LogsActivity;

  protected $fillable = [
    'topic',
    'category_id',
    'description',
    'trainer_id',
    'client_requirement',
    'client_target'
  ];

  //Log activity
  protected static $logAttributes = [
    'topic',
    'category_id',
    'description',
    'trainer_id',
    'client_requirement',
    'client_target'
  ];

  protected static $logName = 'Topic';

  public function getDescriptionForEvent(string $eventName): string
  {
    return "This user has been {$eventName} data Topic";
  }

  protected static $logOnlyDirty = true;
  //end Log Activity

  public function trainer()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function category()
  {
    return $this->belongsTo('App\Models\Category');
  }

  public function clients()
  {
    return $this->belongsToMany('App\Models\Client');
  }

  public function question()
  {
    return $this->hasMany('App\Models\Question');
  }

  public function sub_topics()
  {
    return $this->hasMany('App\Models\Sub_topic');
  }
}
