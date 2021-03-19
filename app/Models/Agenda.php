<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
		use HasFactory;

		protected $fillable = ['client_id','plan_id','session','type_session','date','duration','status','owner_id'];

		//protected $attributes = ['status' => 'unschedule'];

	public function client() {
		return $this->belongsTo('App\Models\Client');
	}

	public function plan() {
		return $this->belongsTo('App\Models\Plan');
	}

	public function agenda_detail() {
		return $this->hasMany('App\Models\Agenda_detail');
	}
}
