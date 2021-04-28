<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training_meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'date_time',
        'media',
        'meeting_url'
    ];

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }
}
