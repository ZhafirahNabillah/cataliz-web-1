<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Report extends Model
{
    use HasFactory, LogsActivity;

    //Log activity
    protected static $logAttributes = [''];

    protected static $logName = 'Report';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Report";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
