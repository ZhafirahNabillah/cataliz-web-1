<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Documentation extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'description',
        'category',
        'role'
    ];

    //Log activity
    protected static $logAttributes = [
        'title',
        'description',
        'category',
        'role'
    ];

    protected static $logName = 'Documentation';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Documentation";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity
}
