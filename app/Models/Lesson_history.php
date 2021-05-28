<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson_history extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'topic_id',
      'lesson_id'
    ];

    public function topic() {
  		return $this->belongsTo('App\Models\Topic');
  	}

    public function user() {
  		return $this->belongsTo('App\Models\User');
  	}

    public function lesson() {
  		return $this->belongsTo('App\Models\Lesson');
  	}
}
