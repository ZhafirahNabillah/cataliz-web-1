<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Plan extends Model
{
	use HasFactory, LogsActivity;

	protected $fillable = [
		'date',
		'objective',
		'success_indicator',
		'development_areas',
		'support',
		'owner_id',
		'type',
		'client_id',
		'group_id'
	];

	//Log activity
	protected static $logAttributes = [
		'date',
		'objective',
		'success_indicator',
		'development_areas',
		'support',
		'owner_id',
		'type',
		'client_id',
		'group_id'
	];

	protected static $logName = 'Plan';

	public function getDescriptionForEvent(string $eventName): string
	{
		return "This user has been {$eventName} data Plan";
	}

	protected static $logOnlyDirty = true;
	//end Log Activity

	public function clients()
	{
		return $this->belongsToMany('App\Models\Client');
	}

	public function client()
	{
		return $this->belongsTo('App\Models\Client');
	}

	public function agenda()
	{
		return $this->hasOne('App\Models\Agenda');
	}

	public function owner()
	{
		return $this->belongsTo('App\Models\Coach');
	}
}
