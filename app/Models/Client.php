<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'program',
        'company',
        'organization',
        'occupation',
        'owner_id',
        'user_id',
    ];

    public function user() {
  		return $this->belongsTo('App\Models\User');
  	}
}
