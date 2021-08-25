<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Training_feedback extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'result_id',
        'description',
        'owner_id',
        'from',
        'to'
    ];

    //Log activity
    protected static $logAttributes = [
        'result_id',
        'description',
        'owner_id',
        'from',
        'to'
    ];

    protected static $logName = 'Training Feedback';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Training Feedback";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity

    public function result()
    {
        return $this->belongsTo('App\Models\Exam_result');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User');
    }
}
