<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
      'lesson_name',
      'video',
      'sub_topic_id'
    ];

    public function sub_topic() {
  		return $this->belongsTo('App\Models\Sub_topic');
  	}

    public function meeting()
    {
      return $this->hasOne('App\Models\Training_meeting', 'lesson_id');
    }
}
