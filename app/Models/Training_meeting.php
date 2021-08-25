<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Training_meeting extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'lesson_id',
        'date_time',
        'media',
        'meeting_url'
    ];

    //Log activity
    protected static $logAttributes = [
        'lesson_id',
        'date_time',
        'media',
        'meeting_url'
    ];

    protected static $logName = 'Training Meeting';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Training Meeting";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }
}
