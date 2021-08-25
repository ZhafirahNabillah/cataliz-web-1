<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Language extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'english_proficiency',
        'other_language',
        'proficiency'
    ];

    //Log activity
    protected static $logAttributes = [
        'english_proficiency',
        'other_language',
        'proficiency'
    ];

    protected static $logName = 'Language';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Language";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity
}
