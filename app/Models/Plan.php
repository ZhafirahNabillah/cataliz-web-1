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
		'type'
	];

	public function clients()
	{
		return $this->belongsToMany('App\Models\Client');
	}
}
