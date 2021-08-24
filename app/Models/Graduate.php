<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Graduate extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'batch_id',
        'certificate_number',
        'certificate_id'
    ];

    //Log activity
    protected static $logAttributes = [
        'user_id',
        'batch_id',
        'certificate_number',
        'certificate_id'
    ];

    protected static $logName = 'Graduate';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Graduate";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function batch()
    {
        return $this->belongsTo('App\Models\Batch');
    }
}
