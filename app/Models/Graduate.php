<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'batch_id',
        'certificate_number',
        'certificate_id'
    ];

    public function user() {
  		return $this->belongsTo('App\Models\User');
  	}

    public function batch() {
  		return $this->belongsTo('App\Models\Batch');
  	}
}
