<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coaching_note extends Model
{
    use HasFactory;

    protected $fillable = ['subject','summary','attachment','send_to_mail','owner_id','agenda_detail_id'];

    public function agenda_detail() {
  		return $this->belongsTo('App\Models\Agenda_detail');
  	}
}
