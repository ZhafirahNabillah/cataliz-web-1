<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skill'
    ];

    public function clients(){
        return $this->belongsToMany('App\Models\Client');
    }

    public function user() {
  		return $this->belongsTo('App\Models\User');
  	}
}
