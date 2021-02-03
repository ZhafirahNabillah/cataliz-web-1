<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
	use HasFactory;

	protected $fillable = [
		'client_id',
		'date',
		'objective',
		'success_indicator',
		'development_areas',
		'support',
		'owner_id'
	];

	public function client()
	{
		return $this->belongsTo('App\Models\Client');
	}
}
