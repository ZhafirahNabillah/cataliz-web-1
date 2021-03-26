<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
      'agenda_detail_id',
      'feedback',
      'attachment',
      'rating',
      'user_id',
      'from',
    ];

    public function agenda_detail() {
  		return $this->belongsTo('App\Models\Agenda_detail');
  	}

    public function user() {
      return $this->belongsTo('App\Models\User');
    }

}
