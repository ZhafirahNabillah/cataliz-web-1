<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Question extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'topic_id',
        'question',
        'answers',
        'weight',
        'true_answer',
        'exam_id'
    ];

    //Log activity
    protected static $logAttributes = [
        'topic_id',
        'question',
        'answers',
        'weight',
        'true_answer',
        'exam_id'
    ];

    protected static $logName = 'Question';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName} data Question";
    }

    protected static $logOnlyDirty = true;
    //end Log Activity

    protected $casts = [
        'answers' => 'array',
        'true_answer' => 'integer'
    ];

    public function topic()
    {
        return $this->belongsTo('App\Models\Topic');
    }

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam');
    }
}
