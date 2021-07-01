<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
  use HasFactory;

  protected $fillable = [
      'program_id',
      'batch_number',
      'start_date',
      'end_date',
      'status'
  ];

  public function program() {
		return $this->belongsTo('App\Models\Program');
	}

  public function clients() {
		return $this->hasMany('App\Models\Client');
	}
}
