<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'category'
    ];

    //Log activity
    protected static $logAttributes = ['category'];

    protected static $logName = 'Category';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Category";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity

    public function topic()
    {
        return $this->hasMany('App\Models\Topic');
    }
}
