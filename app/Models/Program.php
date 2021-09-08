<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Program extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'program_name'
    ];

    //Log activity
    protected static $logAttributes = ['program_name'];

    protected static $logName = 'Program';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Program";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity

    public function batches()
    {
        return $this->hasMany('App\Models\Batch');
    }
    public function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }
}
