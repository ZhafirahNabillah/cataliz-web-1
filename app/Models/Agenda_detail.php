<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda_detail extends Model
{
    use HasFactory;

    protected $fillable = ['agenda_id','session_name','topic','date','time','media','media_url','duration','status'];

    // protected $dates = ['date'];

    public function agenda() {
      return $this->belongsTo('App\Models\Agenda');
    }

    public function note(){
  		return $this->hasOne('App\Models\Coaching_note');
  	}

    public function feedbacks(){
  		return $this->hasMany('App\Models\Feedback');
  	}
}
