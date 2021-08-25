<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Agenda extends Model
{
	use HasFactory, LogsActivity;

	protected $fillable = ['client_id', 'plan_id', 'session', 'type_session', 'date', 'duration', 'status', 'owner_id'];

	//Log activity
	protected static $logAttributes = ['client_id', 'plan_id', 'session', 'type_session', 'date', 'duration', 'status', 'owner_id'];

	protected static $logName = 'Agenda';

	public function getDescriptionForEvent(string $eventName): string
	{
		return "This user has been {$eventName} data Agenda";
	}

	protected static $logOnlyDirty = true;
	//end Log Activity

	//protected $attributes = ['status' => 'unschedule'];

	public function client()
	{
		return $this->belongsTo('App\Models\Client');
	}

	public function plan()
	{
		return $this->belongsTo('App\Models\Plan');
	}

	public function agenda_detail()
	{
		return $this->hasMany('App\Models\Agenda_detail');
	}
}
