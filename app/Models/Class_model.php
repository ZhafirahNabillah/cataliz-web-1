<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_model extends Model
{
  use HasFactory;

  protected $table = 'class';
  protected $fillable = ['class_name', 'coach_id', 'status'];

  public function coach()
  {
    return $this->belongsTo('App\Models\User');
  }
}
