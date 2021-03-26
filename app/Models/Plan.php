<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
	use HasFactory;

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

	public function clients()
	{
		return $this->belongsToMany('App\Models\Client');
	}

	public function client()
	{
		return $this->belongsTo('App\Models\Client');
	}

	public function agenda(){
		return $this->hasOne('App\Models\Agenda');
	}

	public function owner(){
		return $this->belongsTo('App\Models\Coach');
	}
}
