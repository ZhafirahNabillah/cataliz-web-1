<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_has_client extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'client_id'];

    public function class() {
  		return $this->belongsTo('App\Models\Class');
  	}

  	public function client() {
  		return $this->belongsTo('App\Models\Client');
  	}
}
