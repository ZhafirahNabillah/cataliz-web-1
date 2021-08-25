<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Education extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'school',
        'field_of_study',
        'degree',
        'start_year',
        'end_year'
    ];

    //Log activity
    protected static $logAttributes = [
        'school',
        'field_of_study',
        'degree',
        'start_year',
        'end_year'
    ];

    protected static $logName = 'Education';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Education";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity
}
