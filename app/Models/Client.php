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
        'company',
        'organization',
        'occupation',
        'owner_id',
        'user_id',
        'batch_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function batch()
    {
        return $this->belongsTo('App\Models\Batch');
    }

    public function coaches()
    {
        return $this->belongsToMany('App\Models\Coach');
    }

    public function plans()
    {
        return $this->belongsToMany('App\Models\Plan');
    }

    public function topics()
    {
        return $this->belongsToMany('App\Models\Topic');
    }

    public function plan()
    {
        return $this->hasMany('App\Models\Plan');
    }

    public function report()
    {
        return $this->hasOne('App\Models\Report');
    }
}
