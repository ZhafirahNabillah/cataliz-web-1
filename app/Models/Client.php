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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function coaches()
    {
        return $this->belongsToMany('App\Models\Coach');
    }

    public function plans()
    {
        return $this->belongsToMany('App\Models\Plan');
    }

    public function plan()
    {
        return $this->hasMany('App\Models\Plan');
    }
}
