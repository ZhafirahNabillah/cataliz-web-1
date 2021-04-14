<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic',
        'description',
        'trainer_id',
        'client_requirement',
        'client_target'
    ];

    public function trainer()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function clients()
  	{
  		return $this->belongsToMany('App\Models\Client');
  	}

    public function question()
  	{
  		return $this->hasMany('App\Models\Question');
  	}
}
