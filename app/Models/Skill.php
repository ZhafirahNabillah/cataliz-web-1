<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Skill extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'skill_name'
    ];

    //Log activity
    protected static $logAttributes = ['skill_name'];

    protected static $logName = 'Skill';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Skill";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity
}
