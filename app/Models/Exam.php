<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
      'topic_id',
      'type',
      'duration',
      'owner_id'
    ];

    public function topic() {
  		return $this->belongsTo('App\Models\Topic');
  	}

    public function owner() {
  		return $this->belongsTo('App\Models\User');
  	}

    public function questions() {
      return $this->hasMany('App\Models\Question', 'exam_id');
    }

    public function results() {
      return $this->hasMany('App\Models\Exam_result', 'exam_id');
    }
}
