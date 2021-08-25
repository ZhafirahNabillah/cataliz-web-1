<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skill_id',
        'category_id',
        'skills_description_title',
        'skills_description_overview',
        'education',
        'employment',
        'language',
        'beginner_status',
        'location'
    ];

    //Log activity
    // protected static $logAttributes = [
    //     'user_id',
    //     'skill_id',
    //     'category_id',
    //     'skills_description_title',
    //     'skills_description_overview',
    //     'education',
    //     'employment',
    //     'language',
    //     'beginner_status',
    //     'location'
    // ];

    // protected static $logName = 'Coach';

    // public function getDescriptionForEvent(string $eventName): string
    // {
    //     return "This user has been {$eventName} data Coach";
    // }

    // protected static $logOnlyDirty = true;
    //end Log Activity

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function plan()
    {
        return $this->hasMany('App\Models\Plan', 'owner_id');
    }
}
