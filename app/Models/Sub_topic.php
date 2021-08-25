<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Sub_topic extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'sub_topic',
        'topic_id'
    ];

    //Log activity
    protected static $logAttributes = [
        'sub_topic',
        'topic_id'
    ];

    protected static $logName = 'Sub Topic';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Sub Topic";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity

    public function topic()
    {
        return $this->belongsTo('App\Models\Topic');
    }

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }
}
