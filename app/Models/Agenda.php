<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
		use HasFactory;
		
		protected $fillable = ['client_id','session','type_session','date','duration','status','owner_id'];

		//protected $attributes = ['status' => 'unschedule'];
	
	public function client() {
		return $this->belongsTo('App\Models\Client');
	}
}
