<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Documentation_details extends Model
{
    use HasFactory, LogsActivity;

    //Log activity
    protected static $logAttributes = [''];

    protected static $logName = 'Documentation Details';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Documentation Details";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity
}
