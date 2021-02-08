<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda_detail extends Model
{
    use HasFactory;

    protected $fillable = ['agenda_id','session_name','topic','date','time','media','media_url','duration','status'];

    public function agenda() {
      return $this->belongsTo('App\Models\Agenda');
    }

    public function coaching_note()
      {
          return $this->hasMany(Coaching_note::class);
      }
}
